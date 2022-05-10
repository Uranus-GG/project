
<?php

    require_once('connect.php'); /*=== ดึงไฟล์เชื่อมต่อ Database เข้ามาใช้งานผ่านโฟลเดอร์ php ===*/
    /**
     * ตรวจสอบเงื่อนไขที่ว่า ตัวแปร $_POST['submit'] ได้ถูกกำหนดขึ้นมาหรือไม่
     */
    if (isset($_POST['submit'])) { 
        /**
         * กำหนดตัวแปรเพื่อมารับค่า
         * ฟังก์ชัน real_escape_string()
         * ใช้สำหรับเลี่ยงการใช้ตัวอักขระพิเศษในคำสั่ง sql เช่น เครื่องหมาย " เครื่องหมาย '
         */
        $m_username =  $conx->real_escape_string($_POST['m_username']);
        $m_password = $conx->real_escape_string(md5($_POST['m_password']));
        /**
         * สร้างตัวแปร $sql เพื่อเก็บคำสั่ง Sql
         * จากนั้นให้ใช้คำสั่ง $conn->query($sql) เพื่อที่จะประมวณผลการทำงานของคำสั่ง sql
         */
        $sql = "SELECT * FROM `member` WHERE `m_username` = '".$m_username."' AND `m_password` = '".$m_password."'";
        $result = $conx->query($sql);
        /**
         * ตรวจสอบการเข้าสู่ระบบ
         */
        if($result->num_rows > 0){
            /**
             * แสดงข้อมูลของ user ด้วย fetch_assoc()
             * เก็บข้อมูล user เข้าสู่ session เพื่อนำไปใช้งานในหน้าอื่นๆ 
             */
            $row = $result->fetch_assoc();
            $_SESSION['m_ID'] = $row['m_ID'];
            $_SESSION['f_name'] = $row['f_name'];
            $_SESSION['l_name'] = $row['l_name'];
            $_SESSION['m_username'] = $row['m_username'];
            $_SESSION['role'] = $row['role'];
            
            /**
             * หลังจากนั้น redirect ไปยังหน้า HOME PAGE
             */
            echo "<script>alert('ยินดีต้อนรับ!');</script>";
            echo "<script>window.location.href='index.php'</script>";
        }else{
            /**
             * แสดงข้อความเมื่อใส่ข้อมูลผิดพลาด
             * สั่ง Refresh หน้าเว็บเพื่อไม่ให้เกิดอาการ Confirm Form Resubmission
             */
			echo "<script>alert('กรุณาลองใหม่อีกครั้ง.');</script>";
            echo "<script>window.location.href='login.php'</script>";
        } 
    }
?>