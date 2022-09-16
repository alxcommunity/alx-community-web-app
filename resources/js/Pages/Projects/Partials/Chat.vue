<template>
     <div class="w-full h-full bg-slate-100">
          <div class=" text-white flex flex-col gap-y-5 px-6 mb-0 absolute w-full bottom-20">
               <div>
                    <p class=" float-right rounded-lg  p-2 px-5 bg-gray-300 text-gray-900"> Welcome every one </p>
               </div>

               <div>
                    <p class=" float-right rounded-lg  p-2 px-5 bg-gray-300 text-gray-900"> hello hello </p>
               </div>

                <div>
                    <p class=" float-left rounded-lg  p-2 px-5 bg-sky-400"> hello my friend </p>
               </div>
          </div>
          <div class="w-11/12 ml-[5%]  absolute bottom-2">
           <input class="w-9/12 rounded-l-md ring-0 border focus:border-0 focus:border-r" placeholder="Write your message" type="text">
           <button class=" w-3/12 bg-sky-400 text-white py-[9px] rounded-r-md ">Send</button>
          </div>
     </div>
</template>

<script>
     export default {
          name:"Index"
     }
</script>