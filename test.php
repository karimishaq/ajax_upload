<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>HTML5 File API</title>
  <style>
	#main {
		width: 300px;
		margin:auto;
		background: #ececec;
		padding: 20px;
		border: 1px solid #ccc;
	}
	 
	#image-list {
		list-style:none;
		margin:0;
		padding:0;
	}
	#image-list li {
		background: #fff;
		border: 1px solid #ccc;
		text-align:center;
		padding:20px;
		margin-bottom:19px;
	}
	#image-list li img {
		width: 258px;
		vertical-align: middle;
		border:1px solid #474747;
	}
  </style>
</head>
<body>
  <div id="main">
    <h1>Upload Your Images</h1>
    <form method="post" enctype="multipart/form-data"  action="upload.php">
		<input type="file" name="images" id="images" multiple />
		<button type="submit" id="tombol">Upload Files!</button>
    </form>
	
	<button onclick="kirim(event)">Upload Files!</button>
 
    <div id="hasil"></div>
    <ul id="image-list">
 
    </ul>
  </div>
 
  <script>
	var input = document.getElementById("images"),
	formdata = false;		
	if (window.FormData) {
		formdata = new FormData();
		document.getElementById("tombol").style.display = "none";
	}
	
	input.addEventListener("change", function (evt) {
		var i = 0, len = this.files.length, img, reader, file;
		var list = document.getElementById("image-list");
		list.innerHTML="";
		
		for ( i=0; i < len; i++ ) {
			file = this.files[i];
			if (file.type.match(/image.*/)){
				if ( window.FileReader ) {
					reader = new FileReader();
					
					reader.onloadend = function (e) { 
						var source=e.target.result;
						var li   = document.createElement("li"),
						img  = document.createElement("img");
						
						img.src = source;
						li.appendChild(img);
						list.appendChild(li);
					};
					
					reader.readAsDataURL(file);
				}
			} 
		}
		
	}, false);
	
	function kirim(evt) {
		var fileku=document.getElementById("images");
		var i = 0, len = fileku.files.length, file;
		
		if(len>0){
			document.getElementById("hasil").innerHTML = "Mengupload . . ."
			
			if (formdata) {
				for ( i=0; i < len; i++ ) {
					file = fileku.files[i];
					formdata.append("images[]", file);
				}
			}
			
			if (formdata) {
				koneksi=new XMLHttpRequest();
				koneksi.open("POST", "upload.php");
				koneksi.send(formdata);
				koneksi.onloadend=function(e){
					document.getElementById("hasil").innerHTML = this.response;
				}
			}
		}
	}
	
  </script>
</body>
</html>