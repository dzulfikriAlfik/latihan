<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales_model extends CI_Model
{
   public function invoice_no()
   {
      $sql     = "SELECT MAX(MID(invoice,9,4)) AS invoice_no 
                  FROM t_sales 
                  WHERE MID(invoice,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d') ";
      $query   = $this->db->query($sql);

      if ($query->num_rows() > 0) {
         $result  = $query->row();
         $n       = ((int)$result->invoice_no) + 1;
         $no      = sprintf("%'.04d", $n);
      } else {
         $no = "0001";
      }
      $invoice = "MYKSR" . date('ymd') . $no;
      return $invoice;
   }
}