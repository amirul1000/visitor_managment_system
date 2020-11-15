<?php

/**
 * Author: Amirul Momenin
 * Desc:Visitor Model
 */
class Visitor_model extends CI_Model
{
	protected $visitor = 'visitor';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get visitor by id
	 *@param $id - primary key to get record
	 *
     */
    function get_visitor($id){
        $result = $this->db->get_where('visitor',array('id'=>$id))->row_array();
		if(!(array)$result){
			$fields = $this->db->list_fields('visitor');
			foreach ($fields as $field)
			{
			   $result[$field] = ''; 	  
			}
		}
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    } 
	
    /** Get all visitor
	 *
     */
    function get_all_visitor(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('visitor')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit visitor
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_visitor($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('visitor')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count visitor rows
	 *
     */
	function get_count_visitor(){
       $result = $this->db->from("visitor")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	
	 /** Get all users-visitor
	 *
     */
    function get_all_users_visitor(){
        $this->db->order_by('id', 'desc');
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('visitor')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit users-visitor
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_users_visitor($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('visitor')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count users-visitor rows
	 *
     */
	function get_count_users_visitor(){
	   $this->db->where('users_id', $this->session->userdata('id'));
       $result = $this->db->from("visitor")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new visitor
	 *@param $params - data set to add record
	 *
     */
    function add_visitor($params){
        $this->db->insert('visitor',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update visitor
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_visitor($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('visitor',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete visitor
	 *@param $id - primary key to delete record
	 *
     */
    function delete_visitor($id){
        $status = $this->db->delete('visitor',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}
