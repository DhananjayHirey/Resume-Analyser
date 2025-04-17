<?php
session_start();
if(isset($_SESSION['name'])){
    $name = $_SESSION['name'];
    $ref = $_SESSION['file_ref'];
    $email = $_SESSION['email'];
    $pno = $_SESSION['p_no'];
    $reg = $_SESSION['reg_no'];
}
else{
    $name = 'Guest';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./output.css">
    <style>
        .bg-change{
            /* outline: 1px solid rgb(34, 32, 32);
             */
             background-color: rgb(224, 223, 223);
        }
    </style>
</head>


<body class="p-4 bg-zinc-300 " >
    <!-- TOPBAR -->
     <div class="w-full shadow-xl shadow-zinc-600 h-60 rounded-2xl bg-zinc-900 bg-[url('../assets/dsh6.png')]  bg-cover bg-bottom mb-4 flex justify-center md:justify-between" >
        <div class="text-zinc-100 flex flex-col item-center md:items-start text-2xl justify-center p-16  " >
            Hello<br><span class=" font-bold block text-8xl" ><?php echo $_SESSION['name'] ?><span>
        </div>
        <div class=" grid-cols-2 grid-rows-2 hidden md:grid" >
            <div class="p-4 flex flex-row justify-between text-sm font-bold text-zinc-100 m-2 backdrop-blur-md ring-1 ring-zinc-600 w-50 rounded-xl bg-white/15 shadow-lg">
                <div>Students<br> Registered</div>
                <div class="flex flex-col items-center gap-0" >
                    <div class="" ><img class="h-10 rounded-full backdrop-blur-lg" src="../assets/stud.png" alt=""></div>
                    <div class="p-4 text-xl " >12</div>
                </div>
            </div>
            <div class="p-4 flex flex-row justify-between text-sm font-bold text-zinc-100 m-2 backdrop-blur-md ring-1 ring-zinc-600 w-50 rounded-xl bg-white/15 shadow-lg">
                <div>Institutes<br> Registered</div>
                <div class="flex flex-col items-center gap-0" >
                    <div class="" ><img class="h-10 rounded-full backdrop-blur-lg" src="../assets/cllg.png" alt=""></div>
                    <div class="p-4 text-xl " >12</div>
                </div>
            </div>
            <div class="p-4 flex flex-row justify-between text-sm font-bold text-zinc-100 m-2 backdrop-blur-md ring-1 ring-zinc-600 w-50 rounded-xl bg-white/15 shadow-lg">
                <div>Documents<br> Analysed</div>
                <div class="flex flex-col items-center gap-0" >
                    <div class="" ><img class="h-10 rounded-full backdrop-blur-lg" src="../assets/docs.png" alt=""></div>
                    <div class="p-4 text-xl " >12</div>
                </div>
            </div>
            <div class="p-4 flex flex-row justify-between text-sm font-bold text-zinc-100 m-2 backdrop-blur-md ring-1 ring-zinc-600 w-50 rounded-xl bg-white/15 shadow-lg">
                <div>Departments<br> Registered</div>
                <div class="flex flex-col items-center gap-0" >
                    <div class="" ><img class="h-10 rounded-full backdrop-blur-lg" src="../assets/dept.png" alt=""></div>
                    <div class="p-4 text-xl " >12</div>
                </div>
            </div>
            
            
            

        </div>
     </div>


<div class="flex w-full justify-center flex-wrap md:justify-between  md:flex-nowrap" >
         
    <!-- SIDEBAR -->
        <div class="flex shadow-2xl md:w-70 shadow-zinc-600 flex-col w-full p-4 bg-zinc-100 h-full rounded-2xl mb-2" >
              
                <div class=" text-sm font-bold ps-2 text-zinc-700" >Main</div>
                <div id="dsh" value="1" class=" pt-2 pb-2 mt-1 mb-1 flex rounded-lg bg-zinc-100 hover:bg-zinc-100 cursor-pointer hover:shadow-[0_10px_20px_rgba(75,_76,_77,_0.5)] " onclick="docs()">
                    <div class="flex flex-row items-center ps-1" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                      <path fill-rule="evenodd"
                      d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z"
                      clip-rule="evenodd" />
                        </svg>
                        <div class="ms-4" >
                            Dashboard
                            
                        </div>
                    </div>
                </div>
           
                <div id="prf" class=" pt-2 pb-2 mt-1 mb-1 flex rounded-lg bg-zinc-100 hover:bg-zinc-100 cursor-pointer hover:shadow-[0_10px_20px_rgba(75,_76,_77,_0.5)] " onclick="prof()" >
                    <div class="flex flex-row items-center ps-1" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                        d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                        clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ms-4" >
                        Profile
                        
                    </div>
                </div>
            <div onclick="session_close()" class=" pt-2 pb-2 mt-1 mb-1 flex rounded-lg bg-zinc-100 hover:bg-zinc-100 cursor-pointer hover:shadow-[0_10px_20px_rgba(75,_76,_77,_0.5)] " >
                <div class="flex flex-row items-center ps-1" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                    d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z"
                    clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ms-4" >
                    Sign-Out
                    
                </div>
            </div>
            <div class=" mt-4 font-bold ps-2 text-zinc-600" >Filters</div>
            <div class="ps-2 flex flex-col" >
                <div class="mt-2 mb-1 text-zinc-700 font-bold text-sm" >Batch</div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="year1" value="2020-2024" class="w-4 h-4 checked:accent-black" >
                    <label for="year1" class="text-sm" >2024</label>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="year2" value="2021-2025" class="w-4 h-4 checked:accent-black" >
                    <label for="year2" class="text-sm" >2025</label>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="year3" value="2022-2026" class="w-4 h-4 checked:accent-black" >
                    <label for="year3" class="text-sm" >2026</label>
                </div>            
            </div>
            <div class="">
                <div class=" ps-2 mt-2 mb-1 text-zinc-700 font-bold text-sm" >University</div>
                    <select name="uni" id="uni" class="w-full rounded-md bg-zinc-200 p-2" >
                        <option value="" class="">All</option>
                        <option value="Lovely" class="">Lovely Prof University</option>
                        <option value="Chandigarh University">Chandigarh University</option>
                        <option value="Delhi University">Delhi University</option>
                    </select>
                    
            </div>
                <div class="">
                    <div class=" ps-2 mt-2 mb-1 text-zinc-700 font-bold text-sm" >Department</div>
                    <select name="dept" id="dept" class="w-full rounded-md bg-zinc-200 p-2" >
                        <option value="" class="">All</option>
                        <option value="Computer" class="">Computer Science</option>
                        <option value="Pharmacy">Pharmacy</option>
                        <option value="Music">Music</option>
                    </select>
                    
                </div>
                <div class="flex flex-col  justify-center items-center mt-4 mb-4" >
                    <button class="w-full shadow-xl shadow-zinc-600 bg-zinc-800 text-white text-sm font-extrabold p-4 rounded-lg cursor-pointer" onclick="apply_filters()">Apply Filters</button>
                </div>
        </div>

    <!-- Image rendering -->
     <!-- <div class="flex" > -->
        <!-- <input type="text" class="w-full bg-amber-200 h-12 outline-2 outline-zinc-800" > -->
        <div class="w-full shadow-2xl shadow-zinc-600 bg-zinc-100 m-4 rounded-2xl flex flex-col items-center justify-center p-4" >
            <img id="image" src="" alt=""> 
             <div id="prof" class="bg-zinc-100 shadow-lg rounded-xl w-full m-4 p-8 hidden overflow-hidden" >
            <div class="flex" >
                <div class="flex flex-col grow-1 w-full" >
                    <div class="mb-4">
                        <div class="ps-4     font-bold mb-2" >Name</div>
                        <input type="text" placeholder="<?php echo $name ?>" class="p-2 rounded-md outline-2 outline-zinc-400 w-full" disabled value="<?php echo $name ?>">
                    </div>
                    <div class="mb-4">
                        <div class="ps-4     font-bold mb-2" >Phone Number</div>
                        <input type="text" placeholder="<?php echo $pno ?>" class="p-2 rounded-md outline-2 outline-zinc-400 w-full" disabled value="<?php echo $pno ?>">
                    </div>
                    <div class="mb-4">
                        <div class="ps-4     font-bold mb-2" >Email</div>
                        <input type="text" placeholder="<?php echo $email ?>" class="p-2 rounded-md outline-2 outline-zinc-400 w-full" disabled value="<?php echo $email ?>">
                    </div>
                    <div class="mb-4">
                        <div class="ps-4     font-bold mb-2" >Reg. No</div>
                        <input type="text" placeholder="<?php echo $reg ?>" class="p-2 rounded-md outline-2 outline-zinc-400 w-full" disabled value="<?php echo $reg ?>">
                    </div>
                </div>
                <div class="flex flex-col items-center w-full h-full ">
                    <div class="rounded-full overflow-hidden " >
                        <img src="../assets/profile.jpg" alt="" class="w-40%" >
                    </div>
                    <div>
                        <p class="text-md font-bold mt-4 mb-4 text-center" ><?php echo $name ?></p>
                        <p class="text-sm text-center" >Admin</p>
                        <p class="text-sm text-center" >@docmatch</p>
                    </div>
                </div>

            </div>
            
            
        </div> 
        </div>
    <!-- </div> -->

    <!-- LISTING THE DOCUMENTS -->
    <div class="flex flex-col w-full md:w-80" >
        <div class="w-full h-12 mb-4 bg-zinc-100 rounded-3xl flex shadow-2xl shadow-zinc-600 " >
            <input id="man_input" type="text" class="w-full bg-zinc-100 rounded-3xl ps-4 p-2 focus:outline-0 " placeholder="Search for...">
            <button onclick="man_search()" class="cursor-pointer" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8 m-2">
                <path d="M8.25 10.875a2.625 2.625 0 1 1 5.25 0 2.625 2.625 0 0 1-5.25 0Z" />
                <path fill-rule="evenodd"
                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.125 4.5a4.125 4.125 0 1 0 2.338 7.524l2.007 2.006a.75.75 0 1 0 1.06-1.06l-2.006-2.007a4.125 4.125 0 0 0-3.399-6.463Z"
                    clip-rule="evenodd" />
                </svg>
            </button>
        </div>
         <div class="flex flex-col w-full shadow-2xl shaodw-zinc-600 w-70 rounded-xl h-100 bg-zinc-100 overflow-hidden" >
             <div class="flex flex-col  overflow-y-scroll " id="docs" >
     
             </div>
         </div>

    </div>
</div>
    
    <script>
        let content={};
        let htmlString="";

        function prof(){
            document.getElementById("prof").style.display="inline";
            document.getElementById("prf").classList.add('bg-change');
            document.getElementById('dsh').classList.remove('bg-change');
            document.getElementById('image').src='';

        }
        
        function docs(){
            document.getElementById("prof").style.display="none";
            document.getElementById("prf").classList.remove("bg-change");
            document.getElementById('dsh').classList.add("bg-change");
            
        }
        
        function display(a){
            // console.log(a);
            const url = '../php/';
            document.getElementById('image').src=url+a;
            document.getElementById("prof").style.display="none";
            document.getElementById("prf").classList.remove("bg-change");
            document.getElementById('dsh').classList.add("bg-change");

        }

        function man_search(){
            console.log('cliked')
            let search_fac = document.getElementById("man_input").value;
            const xhr = new XMLHttpRequest();
            xhr.open("POST",`../php/fetch.php`,true);
            xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            xhr.onload = function(){
                if(xhr.status==200){
                    // console.log(xhr.responseText);
                    content = JSON.parse(xhr.responseText);
                    // console.log(content);
                    for(let index=0;index<content.length;index++){
                        htmlString+=`<button class="cursor-pointer ps-4 p-2 text-sm text-zinc-800 font-bold hover:shadow-md hover:shadow-zinc-600" onclick="display('${content[index].ref}')" >${content[index].name}</button>`;
                    }
                    document.getElementById('docs').innerHTML=htmlString;

                }
                else{
                    console.log("couldn't connect to the database");
                }
            };
            const requestData = `year1=${encodeURIComponent("")}&year2=${encodeURIComponent("")}&year3=${encodeURIComponent("")}&uni=${encodeURIComponent("")}&dept=${encodeURIComponent("")}&man_inp=${encodeURIComponent(search_fac)}`;
            xhr.send(requestData);

        }

        function apply_filters(){
            let year1="";
            let year2="";
            let year3="";
            let uni="";
            let dept="";
            if(document.getElementById("year1").checked){
                year1 = document.getElementById("year1").value;
            }
            if(document.getElementById("year2").checked){
                year2 = document.getElementById("year2").value;
            }
            if(document.getElementById("year3").checked){
                year3 = document.getElementById("year3").value;
            }

            uni = document.getElementById("uni").value;
            dept = document.getElementById("dept").value;
            const xhr = new XMLHttpRequest();
            xhr.open("POST",`../php/fetch.php`,true);
            xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            xhr.onload = function(){
                if(xhr.status==200){
                    content = JSON.parse(xhr.responseText);
                    // console.log(content);
                    for(let index=0;index<content.length;index++){
                        htmlString+=`<button class="cursor-pointer ps-4 p-2 text-sm text-zinc-800 font-bold" onclick="display('${content[index].ref}')" >${content[index].name}</button>`;
                    }
                    document.getElementById('docs').innerHTML=htmlString;

                }
                else{
                    console.log("couldn't connect to the database");
                }
            };
            const requestData = `year1=${encodeURIComponent(year1)}&year2=${encodeURIComponent(year2)}&year3=${encodeURIComponent(year3)}&uni=${encodeURIComponent(uni)}&dept=${encodeURIComponent(dept)}&man_inp=${encodeURIComponent("")}`;
            xhr.send(requestData);

        }

        function session_close(){
            window.location.href = "test-1.html";
        }

    </script>
    <!-- LISTING THE DOCUMENTS -->
</body>
</html>