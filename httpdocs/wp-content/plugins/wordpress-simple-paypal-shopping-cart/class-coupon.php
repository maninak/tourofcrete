<?php
class WPSPSC_Coupons_Collection
{
    var $coupon_items = array();
    
    function __construct()
    {
        
    }
    
    function add_coupon_item($coupon_item)
    {
        array_push($this->coupon_items, $coupon_item);
    }
    
    function find_coupon_by_code($coupon_code)
    {
        if(empty($this->coupon_items)){
            echo "<br />".(__("Admin needs to configure some discount coupons before it can be used", "wordpress-simple-paypal-shopping-cart"));
            return new stdClass();
        }
        foreach($this->coupon_items as $key => $coupon)
        {
            if(strtolower($coupon->coupon_code) == strtolower($coupon_code)){
                return $coupon;
            }
        }
        return new stdClass();
    }
    
    function delete_coupon_item_by_id($coupon_id)
    {
        $coupon_deleted = false;
        foreach($this->coupon_items as $key => $coupon)
        {
            if($coupon->id == $coupon_id){
                $coupon_deleted = true;
                unset($this->coupon_items[$key]);
            }
        }
        if($coupon_deleted){
            $this->coupon_items = array_values($this->coupon_items);
            WPSPSC_Coupons_Collection::save_object($this);
        }
    }
    
    function print_coupons_collection()
    {
        foreach ($this->coupon_items as $item){
            $item->print_coupon_item_details();
        }
    }
       
    static function save_object($obj_to_save)
    {
        update_option('wpspsc_coupons_collection', $obj_to_save);
    }
    
    static function get_instance()
    {
        $obj = get_option('wpspsc_coupons_collection');
        if($obj){
            return $obj;
        }else{
            return new WPSPSC_Coupons_Collection();
        }
    }
}
