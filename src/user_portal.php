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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        .bg-change{
            /* outline: 1px solid rgb(34, 32, 32);
             */
             background-color: rgb(224, 223, 223);
        }
    </style>

</head>
<body class="p-4 bg-gradient-to-br min-h-screen from-zinc-400 to-zinc-950"> 

    <!-- TOPBAR -->
     <div class="h-50 w-full bg-zinc-900 rounded-2xl bg-[url('../assets/dsh6.png')] bg-cover flex justify-center items-center">
        <div class="p-4 flex text-center font-bold text-zinc-100 m-2 backdrop-blur-md ring-1 ring-zinc-600 w-50 rounded-xl bg-white/15 shadow-lg">
            <div id="u_name" class="text-center text-2xl w-full">Hello<br><?php echo $name ?></div>
        </div>
     </div>

     <!-- MAIN CONTENT AREA -->
    <div class="flex w-full mt-4 gap-4">
        <!-- SIDEBAR -->
        <div class="w-64 flex-shrink-0">
            <div class="bg-zinc-100 rounded-2xl flex flex-col p-4 w-full">                 
                <div class="text-sm font-bold ps-2 text-zinc-700">Main</div>

                <div id="dash" value="1" onclick="docs()" class="pt-2 pb-2 mt-1 mb-1 flex rounded-lg bg-zinc-100 hover:bg-zinc-100 cursor-pointer hover:shadow-[0_10px_20px_rgba(75,_76,_77,_0.5)]">
                    <div class="flex flex-row items-center ps-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ms-2">Upload Docs</div>
                </div>

                <div id="profile" onclick="prof()" class="pt-2 pb-2 mt-1 mb-1 flex rounded-lg bg-zinc-100 hover:bg-zinc-100 cursor-pointer hover:shadow-[0_10px_20px_rgba(75,_76,_77,_0.5)]">
                    <div class="flex flex-row items-center ps-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ms-2">Profile</div>
                </div>
                <div id="profile" onclick="redirect()" class="pt-2 pb-2 mt-1 mb-1 flex rounded-lg bg-zinc-100 hover:bg-zinc-100 cursor-pointer hover:shadow-[0_10px_20px_rgba(75,_76,_77,_0.5)]">
                    <div class="flex flex-row items-center ps-1">
                        <img src="..//assets/feedback.png" class="h-6" alt="">
                    </div>
                    <div class="ms-2">Feedback</div>
                </div>
                
                <div onclick="log_out()" class="pt-2 pb-2 mt-1 mb-1 flex rounded-lg bg-zinc-100 hover:bg-zinc-100 cursor-pointer hover:shadow-[0_10px_20px_rgba(75,_76,_77,_0.5)]">
                    <div class="flex flex-row items-center ps-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ms-2">Sign-Out</div>
                </div> 
            </div>               
        </div>
        
        <!-- CONTENT AREA -->
        <div class="flex-grow">
            <!-- UPLOAD_FORM -->
            <div id="upload" class="content-panel flex ms-2">
                <div class="bg-zinc-200 shadow-2xl rounded-2xl p-8 w-full">
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
                        <div id="note"></div>
                        <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-3 px-4 rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-opacity-50 transition-all shadow-lg hover:shadow-xl">
                            Upload Document
                        </button>
                    </form>
                        
                    <div class="mt-6 text-center text-sm text-gray-500">
                        <p>Report a problem? <a href="#" class="text-indigo-600 hover:underline">Contact Us</a></p>
                    </div>
                </div>

                <!-- WORKFLOW CONTAINER -->
                <div id="workflow-container" class="w-full overflow-hidden bg-zinc-300 rounded-2xl flex flex-col h-140 ms-2">
                    <div class="text-3xl text-center mt-4 font-bold">
                        DocMatch
                    </div>
                    <div class="text-md text-zinc-800 text-center">
                        how it works...
                    </div>
                    <!-- Replace the existing workflow section with this code -->
    <div id="workflow" class="container overflow-y-scroll h-full p-4">
        <div class="grid grid-cols-1 gap-6">
            <!-- Step 1: Sign Up -->
            <div class="bg-white rounded-xl p-4 shadow-md">
                <div class="flex items-center mb-3">
                    <div class="bg-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center font-bold mr-3">1</div>
                    <h3 class="text-lg font-bold text-gray-800">User Sign Up</h3>
                </div>
                <div class="bg-gray-100 rounded-lg p-3 flex justify-center">
                    <div class="w-3/4">
                        <div class="h-3 bg-gray-300 rounded mb-2 w-full"></div>
                        <div class="h-3 bg-gray-300 rounded mb-2 w-full"></div>
                        <div class="h-3 bg-gray-300 rounded mb-2 w-3/4"></div>
                        <div class="h-5 bg-blue-500 rounded w-1/2 mt-3 mx-auto"></div>
                    </div>
                </div>
            <p class="text-sm text-gray-600 mt-2">Create an account to access all features</p>
        </div>

        <!-- Step 2: Upload Resume -->
        <div class="bg-white rounded-xl p-4 shadow-md">
            <div class="flex items-center mb-3">
                <div class="bg-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center font-bold mr-3">2</div>
                <h3 class="text-lg font-bold text-gray-800">Upload Resume</h3>
            </div>
            <div class="bg-gray-100 rounded-lg p-3 flex justify-center">
                <div class="w-3/4 bg-white p-2 rounded border-2 border-dashed border-gray-300">
                    <div class="flex justify-center mb-2">
                        <div class="w-6 h-8 bg-gray-300 rounded"></div>
                    </div>
                    <div class="h-2 bg-gray-300 rounded mb-1 w-full"></div>
                    <div class="h-2 bg-gray-300 rounded mb-1 w-full"></div>
                    <div class="h-2 bg-gray-300 rounded mb-1 w-3/4"></div>
                    <div class="h-2 bg-gray-300 rounded mb-1 w-5/6"></div>
                </div>
            </div>
            <p class="text-sm text-gray-600 mt-2">Upload your resume document for analysis</p>
        </div>

        <!-- Step 3: OCR Analysis -->
        <div class="bg-white rounded-xl p-4 shadow-md">
            <div class="flex items-center mb-3">
                <div class="bg-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center font-bold mr-3">3</div>
                <h3 class="text-lg font-bold text-gray-800">Tesseract OCR Analysis</h3>
            </div>
            <div class="bg-gray-100 rounded-lg p-3 flex justify-center">
                <div class="w-3/4">
                    <div class="h-4 bg-blue-200 rounded mb-2 w-full"></div>
                    <div class="flex space-x-2">
                        <div class="w-1/2">
                            <div class="h-2 bg-gray-300 rounded mb-1 w-full"></div>
                            <div class="h-2 bg-yellow-300 rounded mb-1 w-3/4"></div>
                            <div class="h-2 bg-gray-300 rounded mb-1 w-full"></div>
                        </div>
                        <div class="w-1/2">
                            <div class="h-2 bg-yellow-300 rounded mb-1 w-1/2"></div>
                            <div class="h-2 bg-gray-300 rounded mb-1 w-full"></div>
                            <div class="h-2 bg-yellow-300 rounded mb-1 w-2/3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-sm text-gray-600 mt-2">AI-powered text extraction and analysis</p>
        </div>

        <!-- Step 4: Admin Panel -->
        <div class="bg-white rounded-xl p-4 shadow-md">
            <div class="flex items-center mb-3">
                <div class="bg-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center font-bold mr-3">4</div>
                <h3 class="text-lg font-bold text-gray-800">Admin Panel Filtering</h3>
            </div>
            <div class="bg-gray-100 rounded-lg p-3 flex justify-center">
                <div class="w-3/4 flex">
                    <div class="w-1/5 bg-gray-700 rounded-l h-full"></div>
                    <div class="w-4/5 pl-2">
                        <div class="h-3 bg-gray-300 rounded mb-2 w-full"></div>
                        <div class="h-2 bg-gray-200 rounded mb-1 w-full"></div>
                        <div class="h-2 bg-gray-200 rounded mb-1 w-full"></div>
                        <div class="h-2 bg-gray-200 rounded mb-1 w-full"></div>
                    </div>
                </div>
            </div>
            <p class="text-sm text-gray-600 mt-2">Filter and manage processed documents</p>
        </div>
    </div>
</div>
                </div>
            </div>

            <!-- PROFILE SECTION -->
            <div id="prof" class="content-panel bg-zinc-200 rounded-xl p-8 hidden ms-2">
                <div class="flex">
                    <div class="flex flex-col w-full">
                        <div class="mb-4">
                            <div class="ps-4 font-bold mb-2">Name</div>
                            <input type="text" placeholder="<?php echo $name ?>" class="p-2 rounded-md outline-2 outline-zinc-400 w-full" disabled>
                        </div>
                        <div class="mb-4">
                            <div class="ps-4 font-bold mb-2">Phone Number</div>
                            <input type="text" placeholder="<?php echo $pno ?>" class="p-2 rounded-md outline-2 outline-zinc-400 w-full" disabled>
                        </div>
                        <div class="mb-4">
                            <div class="ps-4 font-bold mb-2">Email</div>
                            <input type="text" placeholder="<?php echo $email ?>" class="p-2 rounded-md outline-2 outline-zinc-400 w-full" disabled>
                        </div>
                        <div class="mb-4">
                            <div class="ps-4 font-bold mb-2">Reg. No</div>
                            <input type="text" placeholder="<?php echo $reg ?>" class="p-2 rounded-md outline-2 outline-zinc-400 w-full" disabled>
                        </div>
                    </div>
                    <div class="flex flex-col items-center w-full h-full">
                    <div class="rounded-full overflow-hidden shadow-2xl shadow-zinc-900" >
                        <img src="../assets/profile.jpg" alt="" class="w-40%" >
                    </div>
                    <div>
                        <p class="text-md font-bold mt-4 mb-4 text-center" ><?php echo $name ?></p>
                        <p class="text-sm text-center" >Student</p>
                        <p class="text-sm text-center" >@docmatch</p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

<script>
    const fileInput = document.getElementById('file');
    const fileChosen = document.getElementById('file-chosen');
    const fileName = document.querySelector('.file-name');
    const removeFile = document.getElementById('remove-file');
    
    // Get content panels
    const contentPanels = document.querySelectorAll('.content-panel');
                    
    function prof() {
        // Hide all content panels
        contentPanels.forEach(panel => {
            panel.classList.add('hidden');
        });
        // Show profile panel
        document.getElementById("prof").classList.remove('hidden');
        // document.getElementById("profile")classList.add('bg-change');
    }

    function redirect(){
        window.location.href = "feedback.php";
    }
    
    function docs() {
        // Hide all content panels
        contentPanels.forEach(panel => {
            panel.classList.add('hidden');
        });
        // Show upload panel
        document.getElementById("upload").classList.remove('hidden');
        // document.getElementById("dash")classList.add('bg-change');
        // document.getElementById("profile")classList.remove('bg-change');
    }

    function log_out() {
        window.location.href = "test-1.html";
    }
        
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

    // Fix the typo in your original code (getElementByID → getElementById)
    document.getElementById("workflow").addEventListener('scroll', () => {
        const elements = document.getElementById('workflow').querySelectorAll('.hidden');
        elements.forEach(el => {
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight - 100) {
                el.classList.add('show');
            }
        });
    });

    // Initialize default view
    window.addEventListener('DOMContentLoaded', () => {
        docs(); // Start with docs view active
    });
</script>
</body>
</html>