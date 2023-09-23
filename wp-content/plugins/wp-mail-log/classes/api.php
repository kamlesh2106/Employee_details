<?php
// phpcs:disable WordPress.DateTime.RestrictedFunctions.date_date
// phpcs:disable WordPress.DB.PreparedSQL.NotPrepared
namespace WML\Classes;

use WML\Classes\Settings;

use WP_REST_Controller;
use WP_REST_Server;
use WP_Query;
use WP_REST_Request;
use WP_Error;
use WP_REST_Response;

/**
 * Plugin API Endpoints
 *
 * This class is to manage plugin api endpoints
 *
 * @extends WP_REST_Controller
 *
*/
class API extends WP_REST_Controller {


	protected $namespace = 'wml/v1';
	/**
	 * The constructor of class. Automatically call when class object create
	 *
	 * @since 0.3
	 * @return void
	 * @access public
	 *
	 */
	public function __construct() {
	}

	/**
	 * This function is called on rest_api_init action in bootstrap file.
	 *
	 * This function will register the rest api endpoints.
	 *
	 * @since 0.3
	 * @return void
	 * @access public
	 *
	 */

	public function register_routes() {
		register_rest_route(
			$this->namespace,
			'/wml_logs',
			// Get Log -> done
			[
				[
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => [ $this, 'view_log' ],
					'permission_callback' => [ $this, 'check_permission' ],
				],
				// // Delete Log -> done
				// [
				// 	'methods'             => WP_REST_Server::DELETABLE,
				// 	'callback'            => [ $this, 'delete_log' ],
				// 	'permission_callback' => [ $this, 'check_permission' ],
				// ],
			]
		);
		register_rest_route(
			$this->namespace,
			'/wml_logs/delete',
			// Get Log -> done
			[
				// Delete Log -> done
				[
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => [ $this, 'delete_log' ],
					'permission_callback' => [ $this, 'check_permission' ],
				],
			]
		);
		register_rest_route(
			$this->namespace,
			'/settings',
			// Save Settings done
			[
				[
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => [ $this, 'save_settings' ],
					'permission_callback' => [ $this, 'check_permission' ],
				],
			]
		);
		register_rest_route(
			$this->namespace,
			'/wml_logs/send_mail',
			// Save Settings done
			[
				[
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => [ $this, 'send_email' ],
					'permission_callback' => [ $this, 'check_permission' ],
				],
			]
		);
	}

	/**
	 * This function return the JSON params to array from request.
	 *
	 * @since 0.3
	 * @param object $reuqest WP Rest Request
	 * @return array
	 * @access private
	 *
	 */

	private function get_params( $request ) {
		return $request->get_json_params();
	}
	private function make_params() {
	}

	/**
	 * This function is called on wml_log api endpoint with creatable method.
	 *
	 * This function return the result of logs based on params.
	 *
	 * @since 0.3
	 * @param \WP_REST_Request $request Full data about the request.
	 * @return \WP_REST_Response Response object log result based on params
	 * @access public
	 *
	 */
	public function view_log( WP_REST_Request $request ) {
		global $wpdb;
		$params = $this->get_params( $request );

		$table_name = $wpdb->prefix . 'wml_entries';

		$query_cols  = [ 'id', 'to_email', 'subject', 'message', 'headers', 'attachments', "DATE_FORMAT(sent_date, '%Y/%m/%d %H:%i:%S') as sent_date", 'attachments_file as files' ];
		$entry_query = 'SELECT distinct ' . implode( ',', $query_cols ) . ' FROM ' . $table_name;
		$where[]     = '1 = 1';

		if ( empty( $params['startDate'] ) ) {
			$params['startDate'] = date( 'Y-m-d H:i:s', strtotime( '-30 days' ) );
		}
		if ( empty( $params['endDate'] ) ) {
			$params['endDate'] = date( 'Y-m-d H:i:s' );
		}
		if ( $params['startDate'] !== '' && $params['startDate'] !== null ) {
			$orignalStartDateTS  = strtotime( $params['startDate'] );
			$params['startDate'] = date( 'Y-m-d', $orignalStartDateTS );
			$where[]             = " DATE_FORMAT(sent_date,GET_FORMAT(DATE,'JIS')) >= '" . $params['startDate'] . "'";
		}
		if ( $params['endDate'] !== '' && $params['endDate'] !== null ) {
			$orignalEndDateTS  = strtotime( $params['endDate'] );
			$params['endDate'] = date( 'Y-m-d', $orignalEndDateTS );
			if ( $params['startDate'] !== '' ) {
				$where[] = " DATE_FORMAT(sent_date,GET_FORMAT(DATE,'JIS')) <= '" . $params['endDate'] . "'";
			} else {
				$where[] = "DATE_FORMAT(sent_date,GET_FORMAT(DATE,'JIS')) <= '" . $params['endDate'] . "'";
			}
		}

		// Filter Query
		$vars = [];
		if($params['filter']){
			foreach ($params['filter'] as $key => $value) {
				if($value['key'] !== ''){
					$operator = $value['operator'];
					if ( $operator === 'LIKE' || $operator == 'NOT LIKE' ) {
						$value['value'] = "%{$value['value']}%";
					}
					$vars[] = " ( {$value['key']} {$value['operator']} '{$value['value']}' ) ";
				}
				
			}

			if($vars){
				$where[] = implode( $params['filterRelation'], $vars );
			}
		}

		// Order By
		$orderby = ' order by id desc';

		if ( $params['pageIndex'] >= 1 ) {
			$limit = ' limit ' . $params['pageSize'] * $params['pageIndex'] . ',' . $params['pageSize'];
		} else {
			$limit = ' limit ' . $params['pageSize'];
		}
		$entry_query .= ' WHERE ' . implode( ' and ', $where ) . $orderby . $limit;
		// echo 'query ' . $entry_query;
		// die();
		$sql = $wpdb->get_results( $entry_query );

		$cols = [];

		foreach ( $wpdb->get_col( 'DESC ' . $table_name, 0 ) as $column_name ) {
			$cols[] = $column_name;
		}
		$entry_count_query = 'SELECT count(id) from ' . $table_name . ' WHERE ' . implode( ' and ', $where );

		$entry_result = $wpdb->get_var( $entry_count_query );
		$rowcount     = $wpdb->num_rows;
		$columns      = [ 'id', 'to_email', 'subject', 'message', 'headers', 'sent_date', 'files' ];

		foreach ( $sql as $key => $row ) {

			if($row->files !== '' && $row->files !== null){
				$files = explode(',',$row->files);
				$attachments = [];
				if($files){
					foreach ($files as $key => $value) {
						$url = wp_upload_dir()['baseurl'].$value;
						$fileExist = file_exists(wp_upload_dir()['basedir'].$value);

						$fileName = substr($value,strripos($value, '/') + 1, strlen($value));
						$attachments[$key] = [
							'name'=> $fileName,
							'path'=> $value,
							'exist'=> $fileExist,
						];	
					}
					$row->files = implode(' ', $files) ;
					$row->dataFile = $attachments;
				}
			}
			
			// Issue with wp forms data so commented
			// $formatedTag  = wp_kses( $row->message, $this->wml_kses_allowed_html( 'post' ) );
			// $row->message = $formatedTag;
		}

		// sanitize $sql recursively
		
		$sql = $this->sanitize_data( $sql );

		$res = [
			'columns'   => $columns,
			'data'      => $sql,
			'totalRows' => $entry_result,
			'rowCount'  => $rowcount,
		];

		return rest_ensure_response( $res );
	}

	/**
	 * This function is called on wml_log api endpoint with deletable method.
	 *
	 * This function return wp rest response on basis of result of delete.
	 *
	 * @since 0.6
	 * @param int $id id to get data
	 * @return $results query results
	 * @access public
	 *
	 */
	public function get_data_by_id( $id ) {
		global $wpdb;

		$table_name = $wpdb->prefix . 'wml_entries';

		$query_cols  = [ 'id', 'subject', 'message', 'headers', 'attachments', "DATE_FORMAT(sent_date, '%Y/%m/%d %H:%i:%S') as sent_date, attachments_file as files" ];
		$entry_query = 'SELECT distinct ' . implode( ',', $query_cols ) . ' FROM ' . $table_name . ' WHERE id=' . $id;

		$result = $wpdb->get_results( $entry_query );

		return $result[0];
	}
	/**
	 * This function is called on wml_log api endpoint with deletable method.
	 *
	 * This function return wp rest response on basis of result of delete.
	 *
	 * @since 0.3
	 * @param \WP_REST_Request $request Full data about the request.
	 * @return \WP_REST_Response Response object on success
	 * @access public
	 *
	 */
	public function delete_log( WP_REST_Request $request ) {

		global $wpdb;
		$ids     = $this->get_params( $request );
		$message = [];

		$table_name = $wpdb->prefix . 'wml_entries';
		// $deleteRow  =  "Delete from {$table_name} where id IN (" . implode( ',', $ids ) . ')';
		$idsPlaceholder = implode( ', ', array_fill( 0, count( $ids ), '%d' ) );
		// PHPCS:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared, WordPress.DB.PreparedSQLPlaceholders.UnfinishedPrepare
		$deleteRow = $wpdb->prepare( "Delete from {$table_name} where id IN ($idsPlaceholder)", $ids );

		$dl1 = $wpdb->query( $deleteRow );
		if ( $dl1 === 0 ) {
			$message['status']  = 'failed';
			$message['message'] = 'Could not able to delete Entries';
		} else {
			$message['status']  = 'passed';
			$message['message'] = 'Entries Deleted';
		}
		return rest_ensure_response( $message );
	}

	/**
	 * This function is called on wml_log api endpoint with deletable method.
	 *
	 * This function return wp rest response on basis of result of delete.
	 *
	 * @since 0.3
	 * @param string $context
	 * @return array allowed html tags in content
	 * @access protected
	 *
	 */
	protected function wml_kses_allowed_html( $context = 'post' ) {

		$allowed_tags = wp_kses_allowed_html( $context );

		$allowed_tags['link'] = [
			'rel'   => true,
			'href'  => true,
			'type'  => true,
			'media' => true,
		];

		return $allowed_tags;
	}
	/**
	 * Check if the user has the permission to edit posts
	 * @access public
	 * @since 0.3
	 * @return bool|\WP_Error True on has permission, or WP_Error object on failure.
	 */
	public function check_permission() {
		// Restrict endpoint to only users who have the edit_posts capability.
		if ( ! current_user_can( 'edit_posts' ) ) {
			return new WP_Error( 'rest_forbidden', esc_html__( 'OMG you can not view private data.', 'wpv-wml' ), [ 'status' => 401 ] );
		}

		// This is a black-listing approach. You could alternatively do this via white-listing, by returning false here and changing the permissions check.
		return true;
	}
	/**
	 * This function is to save settings
	 * @access public
	 * @since 0.3
	 * @param \WP_REST_Request $request Full data about the request.
	 * @return \WP_REST_Response Response object on success
	 */
	public function save_settings( WP_REST_Request $request ) {
		// TODO :: need to update return type with wp_rest_respnse
		$params   = $this->get_params( $request );
		$callback = $params['callback'];
		$settings = new Settings();
		$res      = $settings->$callback( $params );
		wp_send_json( $res );
	}

	/**
	 * This function is to send email
	 * @access public
	 * @since 0.5
	 * @param \WP_REST_Request $request Full data about the request.
	 * @return \WP_REST_Response Response object on success
	 */

	public function send_email( WP_REST_Request $request ) {
		$uploadDir = trailingslashit(wp_get_upload_dir()['basedir']);
		
		$params = $request->get_body_params();
		$files =  $request->get_file_params();

		$id        = $params['id'];
		$type      = $params['type'];
		$mail_data = (array) $this->get_data_by_id( $id );

		$email       = $params['to_email'];
		$subject     = $mail_data['subject'];
		$message     = $mail_data['message'];
		$attachments = [];
		$newFiles = [];

		$includeAttachment = json_decode($params['includeAttachment']);
		
		// Attach original files
		if($includeAttachment){
			foreach ($includeAttachment as $key => $value) {
				$attachments[] = $uploadDir . $key;
			}
		}

		// Attach Uploaded files
		foreach ($files as $key => $value) {
			$extension = pathinfo($files[$key]['name'], PATHINFO_EXTENSION);
			$time = time();
			$targetFile = trailingslashit(wp_upload_dir()['basedir']). $time . '.' . $extension;
			$targetUrl = $uploadDir . $time . '.' . $extension;

			move_uploaded_file($files[$key]['tmp_name'],  $targetFile);
			$attachments[] = $targetUrl;
			$newFiles[] = $targetFile;
		}

		$headers     = '';
		if ( $type === 'forward' ) {
			$headers = $mail_data['headers'];
			if($headers == ''){
				$headers = 'Content-Type: text/html';
			}
		} else {
			$orignalFiles = explode(',',$mail_data['files']);
			foreach ($orignalFiles as $key => $value ) {
				if($value){
					$attachments[] = $uploadDir . trim($value);
				}
			}
			$headers = $params['headers'];
		}

		$response = wp_mail( $email, $subject, $message, $headers, $attachments );
		
		foreach ($newFiles as $key => $value) {
			wp_delete_file($value);
		}
		return rest_ensure_response( $response );
	}

	function sanitize_data( $data ) {

		$sanitized_data = [];
		
		$allowed_html = wp_kses_allowed_html('post');
		$allowed_html['style'] = [];

		foreach ( $data as $key => $row ) {
			$sanitized_data[] = [
				'id' 	=> $row->id,
				'to_email' => $row->to_email,
				'subject' => sanitize_text_field( $row->subject ),
				'message' => wp_kses( $row->message, $allowed_html ),
				'headers' =>  $row->headers,
				'attachments' => $row->attachments,
				'sent_date' => 	$row->sent_date,
				'files' => $row->files,
			];
		}

		return $sanitized_data;
	}
}
