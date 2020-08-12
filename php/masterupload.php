<?php
	
	$status = array();
	$ceks = 0; 
	$realcode = "";
	$panduan = "";

	if (isset($_POST['submit'])) {

		$dir_image			= "../imagedir/";
		$dir_soal			= "../soaldir/";
	    $allowed_types_img	= array('jpg', 'png', 'jpeg');
	    $max_size = 2000000;
	    $auth = 0;


	    if ($_FILES['soal']['error'] > UPLOAD_ERR_OK) {
	    		 $status  = "file tidak boleh kosong";
	    }
	    	else{
	           	$files_tmpname = $_FILES['soal']['tmp_name']; 
	            $files_name = $_FILES['soal']['name']; 
	            $files_size = $_FILES['soal']['size'];
	            $matauji = $_POST['matauji']; 
	            $durasi = $_POST['durasi']; 
	            $jumsol = $_POST['jumsol']; 


	            $files_ext = pathinfo($files_name, PATHINFO_EXTENSION);
	            $filepaths = $dir_soal.$files_name;
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "cobadata-skripsi";
				$dbnames = "soal";
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
				$conns = mysqli_connect($servername, $username, $password, $dbnames);
				
					if (!$conn) {
					    die("Connection failed: " . mysqli_connect_error());
					}



				//query disini
				$sql = "INSERT INTO listsoal (code,namasoal,matauji,jumsol,durasi,date,time)
						VALUES ('". $code ."','". $files_name ."','". $matauji ."','". $jumsol ."','". $durasi ."', NOW(), CURTIME())";

				$sqls = "CREATE TABLE `".$code."` (
							id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
							nis int(10) NOT NULL,
							formula int(20) NOT NULL,
							nilai int(20) NOT NULL,
							date date,
							time time,
							file VARCHAR(50) NOT NULL
						)";

				//stop



				foreach ($_FILES['files']['tmp_name'] as $key => $value) { 

					$ceks ++;
		            
		            $file_tmpname = $_FILES['files']['tmp_name'][$key]; 
		            $file_name = $_FILES['files']['name'][$key]; 
		            $file_size = $_FILES['files']['size'][$key]; 
		            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION); 



		            $filepath = $dir_image.$file_name; 

			            if(file_exists($filepath) == false && in_array(strtolower($file_ext), $allowed_types_img) == true) {
				            if($files_ext == "csv" && file_exists($filepaths) == false) { 
				            	$auth = 1;

				                if ($files_size > $max_size)       
				                	$auth = 0;
				                
				                if ($auth == 0) {
				                     $status[0] = "file terlalu besar </br>";
				                }
				                else{

				                    if( move_uploaded_file($files_tmpname, $filepaths) && mysqli_query($conn, $sql) == true) {
				                    	if (mysqli_query($conns, $sqls) == true) {
					                        // echo "File {$files_name}berhasil di upload <br />";
					                        $status[0] = "File {$files_name} berhasil di upload <br />";
					            			$realcode = "kode soal : ".$code;
											$panduan = "simpan kode soal untuk mengakses soal";
											$auth = 0;
					                        // echo $GLOBALS["code"]."</br>"; 
				                    	} 
				                    } 
				                    else{                   
				                        $status[0] = "Gagal upload {$files_name} <br />";
				                            // echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
				                    } 
				                }
									$conn->close();


						            	$auth = 1;

						                if ($file_size > $max_size)       
						                	$auth = 0;
						                
						                if ($auth == 0) {
						                    echo "gambar terlalu besar </br>";
						                }
						                else{

						                    if( move_uploaded_file($file_tmpname, $filepath)) { 
						                        $status[1] =  "File {$file_name} berhasil di upload <br />";
						                        
						                    } 
						                    else {                   
						                        $status[1] =  "Gagal upload {$file_name} <br />"; 
						                    } 
						                }

				            } 
				            else { 
								 $status[0] =  "(file {$files_name} tidak support, atau sudah ada, coba file lain)<br / >"; 
				            }


			            }
			            else{
	
	                       $status[1] =  "{$file_name} sudah ada atau tidak support <br />"; 

			            }
	    	    }
   			}
   	}
?>