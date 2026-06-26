<?php
    if (!function_exists('lastDay') && !function_exists('getCondition')) {
        function lastDay($month) {
            $yr = (string)date('Y');
            $fd = $yr.'-'.$month.'-'.(string)date('d');
            $sd = new DateTime($fd);			
            $sd->modify('last day of this month');
            return $sd->format('d');
        }

        function getCondition($id, $month) {
            $yr = (string)date('Y');
            $before = $yr.'-'.$month.'-01';
            $after = $yr.'-'.$month.'-'.lastDay('01');
            return "user_id='$id' AND type='Monthly Due' AND created_at >= '$before' AND created_at <= '$after'";
        }
    }
?>