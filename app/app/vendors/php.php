<?php
 //Purchases
        $pch= dbConnect()->prepare("SELECT sum(total) AS amount FROM porder WHERE branch='$branch' AND YEAR(created)= Year(CURRENT_DATE()) GROUP BY code ORDER BY id DESC");
        //Income
        //$pch=$query2;
        $pch->execute();
        $pr=$pch->fetch();
        $purchase = $ra['amount'];
        
        
        
        $query= dbConnect()->prepare("SELECT sum(amount) AS amount, custID  AS cust, created, code, order_no FROM sorder WHERE branch='$branch' AND WEEK(created)= WEEK(CURRENT_DATE()) GROUP BY code ORDER BY id DESC");
            //Income
            $sq=$query;
            $sq->execute();
            $rb=$sq->fetch();
            $inc = $ra['amount'];
            
            
            //expenses
            $ss = dbConnect()->prepare("Select sum(total) as amount From expense Where branch='$branch' AND WEEK(created)= WEEK(CURRENT_DATE())");
            //expenses for chart 
            $exp=$ss;
            $exp->execute();
            $ra=$exp->fetch();
            $exep = $ra['amount'];
