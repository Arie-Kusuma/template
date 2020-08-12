<?php 

	if (isset($_POST['submit'])) {

		$dir_image			= "../imagedir/";
		$dir_soal			= "../soaldir/";
	    $allowed_types_img	= array('jpg', 'png', 'jpeg');
	    $allowed_types_soal	= array('csv', 'csv', 'csv');
	    $max_size = 2000000;
	    $auth = 0;

	    if ($_FILES['soal']['error'] > UPLOAD_ERR_OK) {
	    		echo "tidak boleh kosong";
	    	}
	    	else{
           	$files_tmpname = $_FILES['soal']['tmp_name']; 
            $files_name = $_FILES['soal']['name']; 
            $files_size = $_FILES['soal']['size']; 
            $files_ext = pathinfo($files_name, PATHINFO_EXTENSION);
            $filepaths = $dir_soal.$files_name;
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "cobadata-skripsi";
			$n=5; 
			function getName($n) { 
			    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
			    $randomString = ''; 
			  
			    for ($i = 0; $i < $n; $i++) { 
			        $index = rand(0, strlen($characters) - 1); 
			        $randomString .= $characters[$index]; 
			    } 
			  
			    return $randomString; 
			} 
			$code = getName($n);

			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());
			}



			//query disini


			$sql = "INSERT INTO listsoal (code,namasoal)
					VALUES ('". $code ."','". $files_name ."')";



			//stop



            if($files_ext == "csv" && file_exists($filepaths) == false) { 
            	$auth = 1;

                if ($files_size > $max_size)       
                	$auth = 0;
                
                if ($auth == 0) {
                    echo "gambar terlalu besar </br>";
                }else{

                    if( move_uploaded_file($files_tmpname, $filepaths) && mysqli_query($conn, $sql) == true) { 
                        echo "File {$files_name}berhasil di upload <br />";
                        echo $code."</br>"; 
                    } 
                    else {                   
                        echo "Gagal upload {$files_name} <br />";
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
                    } 
                }
                
            } 
            else { 
				 echo "(file {$files_name} tidak support, atau sudah ada, coba file lain)<br / >"; 
            }

			$conn->close();


			foreach ($_FILES['files']['tmp_name'] as $key => $value) { 
            
            $file_tmpname = $_FILES['files']['tmp_name'][$key]; 
            $file_name = $_FILES['files']['name'][$key]; 
            $file_size = $_FILES['files']['size'][$key]; 
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION); 


            $filepath = $dir_image.$file_name; 

            if(in_array(strtolower($file_ext), $allowed_types_img) && file_exists($filepath) == false) { 
            	$auth = 1;

                if ($file_size > $max_size)       
                	$auth = 0;
                
                if ($auth == 0) {
                    echo "gambar terlalu besar </br>";
                }else{

                    if( move_uploaded_file($file_tmpname, $filepath)) { 
                        echo "File {$file_name}berhasil di upload <br />"; 
                    } 
                    else {                   
                        echo "Gagal upload {$file_name} <br />"; 
                    } 
                }
                
            } 
            else { 
				 echo "(file {$file_name} tidak support atau sudah ada, coba gambar lain)<br / >"; 
            }
        }
    }
	}

 ?>