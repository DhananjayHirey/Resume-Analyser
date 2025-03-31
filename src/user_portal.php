<?php
session_start();

if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
    $ref = $_SESSION['file_ref'];
    $email = $_SESSION['email'];
    $pno = $_SESSION['p_no'];
    $reg = $_SESSION['reg_no'];

} else {
    $name = "Guest";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Matching</title>
    <link rel="stylesheet" href="output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class=" p-4  bg-gradient-to-br min-h-screen from-zinc-400 to-zinc-950"> 

    <!-- TOPBAR -->
     <div class="h-50 w-full bg-zinc-900 rounded-2xl bg-[url('../assets/dsh6.png')]  bg-cover flex justify-center items-center" >
        <div
            class="p-4 flex text-center font-bold text-zinc-100 m-2 backdrop-blur-md ring-1 ring-zinc-600 w-50 rounded-xl bg-white/15 shadow-lg">
            <div id="u_name" class="text-center text-2xl w-full" >Hello<br><?php echo $name ?></div>
            
        </div>
     </div>

     <!-- BOTTOMBAR -->
    <div class="flex w-full" >
        <div class="flex w-full" >
            <div class=" bg-zinc-100 rounded-2xl mt-4 flex flex-col mb-2 p-4 w-80" >                 
            <div class=" text-sm font-bold ps-2 text-zinc-700">Main</div>

            <div value="1" onclick="docs()" class=" pt-2 pb-2 mt-1 mb-1 flex rounded-lg bg-zinc-100 hover:bg-zinc-100 cursor-pointer hover:shadow-[0_10px_20px_rgba(75,_76,_77,_0.5)] ">
                <div class="flex flex-row items-center ps-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                    d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z"
                    clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ms-2">
                    View Docs                
                </div>
            </div>


            <div id="profile" onclick="prof()"
                class=" pt-2 pb-2 mt-1 mb-1 flex rounded-lg bg-zinc-100 hover:bg-zinc-100 cursor-pointer hover:shadow-[0_10px_20px_rgba(75,_76,_77,_0.5)] ">
                <div class="flex flex-row items-center ps-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                    d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                    clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ms-2">
                    Profile    
                </div>
            </div>
            
            <div
                class=" pt-2 pb-2 mt-1 mb-1 flex rounded-lg bg-zinc-100 hover:bg-zinc-100 cursor-pointer hover:shadow-[0_10px_20px_rgba(75,_76,_77,_0.5)] ">
                <div class="flex flex-row items-center ps-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                fill="currentColor" class="size-6">
                <path fill-rule="evenodd"
                d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z"
                clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ms-2">
                Sign-Out                        
            </div>
            </div> 
        </div>               
    

        <!-- UPLOAD_FORM -->
        <div id="upload" class='m-4 w-full flex items-center justify-center ' >
            
            <div class=" bg-zinc-200 shadow-2xl rounded-2xl p-8 max-w-md w-full mx-4">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 text-blue-600 mb-4">
                        <i class="fas fa-file-upload text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">Document Upload</h2>
                    <p class="text-gray-500 mt-2">Upload your files for document matching</p>
                </div>
                
                <form action="../php/upload.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                    <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 transition-all hover:border-blue-500 group">
                        <input type="file" name="file" id="file" required class="absolute inset-0 w-full h-full opacity-0 z-10">
                        <div class="text-center">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                            <p class="mt-4 text-sm font-medium text-gray-700">Drag and drop your file here or</p>
                            <p class="text-sm font-medium text-blue-600">Browse files</p>
                            <p class="mt-2 text-xs text-gray-500">Supported formats: PDF, DOCX Only</p>
                        </div>
                    </div>
                    
                    <div id="file-chosen" class="hidden px-4 py-3 bg-blue-50 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-file-alt text-blue-500 mr-3"></i>
                            <span class="text-sm font-medium text-gray-700 file-name">No file chosen</span>
                            <button type="button" class="ml-auto text-gray-400 hover:text-red-500" id="remove-file">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div id="note" ></div>
                        <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-3 px-4 rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-opacity-50 transition-all shadow-lg hover:shadow-xl">
                            Upload Document
                        </button>
                </form>
                    
                    <div class="mt-6 text-center text-sm text-gray-500">
                        <p>Report a problem? <a href="#" class="text-indigo-600 hover:underline">Contact Us</a></p>
                    </div>
            </div>
                <!-- UPLOAD_FORM ENDS HERE -->
                
        </div>
            <!-- PROFILE STARTS HERE -->
        <div id="prof" class="bg-zinc-200 rounded-xl w-full m-4 p-8 hidden overflow-hidden" >
            <div class="flex" >
                <div class="flex flex-col grow-1" >
                    <div class="mb-4">
                        <div class="ps-4     font-bold mb-2" >Name</div>
                        <input type="text" placeholder="<?php echo $name ?>" class="p-2 rounded-md outline-2 outline-zinc-400 w-full" >
                    </div>
                    <div class="mb-4">
                        <div class="ps-4     font-bold mb-2" >Phone Number</div>
                        <input type="text" placeholder="<?php echo $pno ?>" class="p-2 rounded-md outline-2 outline-zinc-400 w-full" >
                    </div>
                    <div class="mb-4">
                        <div class="ps-4     font-bold mb-2" >Email</div>
                        <input type="text" placeholder="<?php echo $email ?>" class="p-2 rounded-md outline-2 outline-zinc-400 w-full" >
                    </div>
                    <div class="mb-4">
                        <div class="ps-4     font-bold mb-2" >Reg. No</div>
                        <input type="text" placeholder="<?php echo $reg ?>" class="p-2 rounded-md outline-2 outline-zinc-400 w-full" >
                    </div>
                </div>
                <div class="">
                    <!-- <img src="../assets/dsh4.jpg" alt="" class="w-30" > -->
                </div>

            </div>
            
            
        </div>
        <!-- PROFILE ENDS HERE -->
    </div>

<script>
    const fileInput = document.getElementById('file');
    const fileChosen = document.getElementById('file-chosen');
    const fileName = document.querySelector('.file-name');
    const removeFile = document.getElementById('remove-file');
                    
    function prof(){
        document.getElementById("upload").style.display="none";
        document.getElementById("prof").style.display="inline";
    }
    
    function docs(){
        document.getElementById("upload").style.display="inline";
        document.getElementById("prof").style.display="none";
        
    }

        // function submit(){
        //     let file_i = document.getElementById('file').files[0]; 
        //     let formData = new FormData();
        //     formData.append("file",files_i);
        //     let xhr = new XMLHttpRequest();
        //     xhr.open("POST","../php/upload.php",true);
        //     xhr.onreadystatechange = function(){
        //         if(xhr.readyState===4 && xhr.status===200){
        //             document.getElementById('note').innerHTML = xhr.responseText;
        //             // console.log(xhr.responseText);
        //         }
        //         else{
        //             document.getElementById('note').innerHTML = "not received";
        //             // console.log("not received");
        //         }
        //     };
        //     xhr.send(formData);
        // }
        
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
                fileChosen.classList.remove('hidden');
            } else {
                fileChosen.classList.add('hidden');
            }
        });
        
        removeFile.addEventListener('click', function() {
            fileInput.value = '';
            fileChosen.classList.add('hidden');
        });
    </script>
</body>
</html>