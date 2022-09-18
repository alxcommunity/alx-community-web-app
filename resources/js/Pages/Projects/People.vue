<template>

         <div class="flex">
               <div class=" w-2/3">

                    <div v-if="$page.props.user && false">
                    <h1 class="text-gray-700 text-3xl font-bold mt-5">New Request</h1>

                    <div class="my-10 flex gap-y-3 flex-col">
                         <figure class="flex gap-x-3 w-full justify-between bg-white p-2 rounded-lg border">
                              <div class="flex gap-x-6">
                                   <img class=" rounded-full" src="https://ui-avatars.com/api/?name=fiba" alt="">
                                   <figcaption>
                                        <div class="pt-2 text-black font-semibold text-lg">  Name me</div>
                                        <div class=" text-sm text-gray-500">Holla man</div>
                                   </figcaption>

                              </div>
                              <div class="flex items-center font-extrabold text-gray-500 mr-5">
                                   <button class=" justify-end mr-5">Reject</button>
                                   <button class=" justify-end px-4 py-2 border rounded-2xl">Accept</button>
                              </div>
                         </figure>

                         <figure class="flex gap-x-3 w-full justify-between bg-white p-2 rounded-lg border">
                              <div class="flex gap-x-6">
                                   <img class=" rounded-full" src="https://ui-avatars.com/api/?name=fiba" alt="">
                                   <figcaption>
                                        <div class="pt-2 text-black font-semibold text-lg">  Name me</div>
                                        <div class=" text-sm text-gray-500">Holla man</div>
                                   </figcaption>

                              </div>
                              <div class="flex items-center font-extrabold text-gray-500 mr-5">
                                   <button class=" justify-end mr-5">Reject</button>
                                   <button class=" justify-end px-4 py-2 border rounded-2xl">Accept</button>
                              </div>
                         </figure>

                    </div>

                    </div>

                    <h1 class="text-gray-700 text-3xl font-bold mt-5"> Members with Access</h1>

                    <div class="my-10 flex gap-y-3 flex-col">
                         <figure v-for="user in project.users" :key="user.id" class="flex gap-x-3 w-full justify-between bg-white p-2 rounded-lg border">
                              <div class="flex gap-x-6">
                                   <img class=" rounded-full" :src="`https://ui-avatars.com/api/?name=user.name=${user.name}`" alt="">
                                   <figcaption>
                                        <div class="pt-2 text-black font-semibold text-lg"> {{user.name}}</div>
                                        <div class=" text-sm text-gray-500">{{user.email}}</div>
                                   </figcaption>

                              </div>
                              <div class="flex items-center font-extrabold text-gray-500 mr-5">
                                   <button class=" justify-end mr-5">Info</button>
                                   <button class=" justify-end px-4 py-2 border rounded-2xl">Remove</button>
                              </div>
                         </figure>

                        

                    </div>
               </div>
         </div>

</template>

<script>

  export default({
     props: ['project'],
     
  })
</script>