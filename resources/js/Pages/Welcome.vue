
<style scoped>
* { box-sizing: border-box;}
#led {
     margin-top: 3rem;
     animation: outeranimation  100s linear  infinite;
    
}

#led div {
     position:absolute;
     left: 0;
     top: 0;
     width: 100%;
     height: 100%;
     transform: rotate(calc(var(--value) * 18deg));
   
}

#led div img {
     position: absolute;
     top: 0;
     left: 0;
     background: yellow;
     height: 60px;
     width: 60px;
     border: 1px solid white;
     border-radius: 50%;
}

section {
    
     animation: inneranimation 50s linear infinite;
}
section figure {
     position:absolute;
     left: 0;
     top: 0;
     width: 100%;
     height: 100%;
     /* background: yellow; */
   
     transform: rotate(calc(var(--fvalue) * 36deg));
   
}

section figure img {
     position: absolute;
     top: 0;
     left: 0;
     background: yellow;
     height: 70px;
     width: 70px;
     border: 1px solid white;
     border-radius: 50%;
}

@keyframes outeranimation {
     from {
          transform: rotate(0deg);
     }
     to {
          transform:rotate(360deg)
     }
}

@keyframes inneranimation {
     from {
          transform: rotate(360deg);
     }
     to {
          transform:rotate(0deg)
     }
}


</style>
<template >
      <app-layout class="relative mb-96 shadow-lg">
           <div class=" flex justify-center" >
                    <div class="container ">
                         <div class=" font-extrabold font-sans text-3xl
                         h-screen flex justify-between z-0 first-line:uppercase overflow-hidden bg-[length:70%] bg-center" style="background-image:url('../../../images/alxLogo.png')">
                              <div class=" uppercase mt-[calc(100vh-88vh)] bg-cover text-gray-700 text-center" >
                                   <div>
                                        
                                   </div>
                                   <h1>Let's <span class="text-4xl text-sky-700"> Join </span> Together Today</h1>
                                   <h1>To Create A <span class="text-4xl text-sky-700"> Fabulous </span></h1>
                                   <h1 class="text-5xl uppercase text-gray-700 font-serif font-bolder py-4">Tomorrow  </h1>
                                   <Link :href="route('register')" class="mt-2 bg-sky-600 p-2 font-bold px-5 box-border text-base border-double ring-2 text-white rounded-md text-right">Join Now</Link>
                              </div>
                              <div class="flex w-2/5 z-0 mt-8">
                                       
                                       <div class="w-full flex flex-col gap-y-2">
                                          <div id="led" ref="outer360" class="   relative w-[400px] h-[400px] flex justify-center items-center ">
                                               <div v-for="i in 20" :key="i" :style="`${'--value:'}`+i" >
                                                    <img :src="`${'https://picsum.photos/200/300?random='}` + i" alt="">
                                               </div>
                                    
                                               
                                               <section ref="inner360" class=" w-[300px] h-[300px] relative">
                                                   <figure v-for="i in 10" :key="i" :style="`${'--fvalue:'}` + i">
                                                        <img :src="`${'https://picsum.photos/200/300?random=2'}` + i" alt="">
                                                   </figure>
                                                   
                                                  
                                               </section>
                                               
                                          </div>
                                             
                                       </div>
                              </div>
                         </div>
                         <div class="relative py-10 -mt-[24em] z-0 ">
                              <div class=" inline-flex text-xl font-extrabold w-full my-10 ml-5 mb-5  gap-7"> <span class="text-sky-600 pb-2 border-b-2 border-sky-600">Teams</span> <span>Blogs</span> </div>
                              <div class="grid grid-cols-4 gap-4 gap-y-2">
                                  

                                   <div class="card bg-white  p-4 rounded-md border shadow-sm" v-for="team in teams" :key="team.id">
                                        <Link :href="route('team.show', {'id': team.id})">
                                        
                                       
                                        <div class="flex gap-4">
                                             <img class="rounded-full h-14 w-14 object-contain" :src="team.avatar" alt="">
                                             <div>
                                                  <h1 class="text-md font-bold text-gray-800 first-letter:uppercase">{{team.title}}</h1>
                                                  <p class="text-sm text-gray-600 line-clamp-2">{{team.description}}</p>
                                                  
                                             </div>
                                        </div>
                                        <div class="flex justify-between pl-2">
                                             
                                             <span class="text-sm text-gray-500 py-4">Projects : {{team.projects_count}}</span>
                                             <div class="flex ml-4  pt-3">
                                                  <figure class="h-8 w-8 rounded-full border overflow-hidden border-gray-50 -ml-3">
                                                       <img width="36" height="36"  :src="`https://ui-avatars.com/api/?name=${team.name}`" alt="">
                                                  </figure>
                                                  <figure v-for="user in team.users" :key="user.id" class="h-8 w-8 rounded-full border overflow-hidden border-gray-50 -ml-3">
                                                       <img width="36" height="36"  :src="`https://ui-avatars.com/api/?name=${user.name}`" alt="">
                                                  </figure>

                                             </div>
                                   

                                        </div>
                                         </Link>
                                   </div>

                                  
                              </div>
                              
                         </div>

                         <div class="flex justify-between h-screen bg-[length:50%] bg-no-repeat bg-center items-center" style="background-image:url('../../../images/alxLogo.png')">
                              <div class=" w-1/2">
                                  <h3 class="uppercase text-4xl w-4/5 font-extrabold tracking-widest font-mono">
                                        create or join a team and make your development faster 
                                  </h3> 
                                  <p class="mt-5  text-gray-600 w-4/5 indent-6">
                                       ALX is all about working together and living a successful life. ALX community teams will help  your dream project  easy by making your development faster and better. finally, we make collaboration so easy and fun. 
                                       
                                  </p>
                              </div>
                              <div class="w-1/2">
                                   <img class="h-96" src="../../../public/images/startup.svg" alt="">
                                   
                              </div>
                         </div>

                         <div class="flex justify-between h-screen bg-[length:50%] bg-no-repeat bg-center items-center" style="background-image:url('../../../images/alxLogo.png')">
                              
                              <div class="w-1/2">
                                   <img class="h-96" src="../../../public/images/buss_nav.svg" alt="">
                                   
                              </div>
                              <div class=" w-1/2">
                                  <h3 class="uppercase text-4xl w-4/5 font-extrabold tracking-widest font-mono">
                                        Manage and track your project development 
                                  </h3> 
                                  <p class="mt-5  text-gray-600 w-4/5 indent-6">
                                       Are having fun building your dream project? now we will help you to make progress not hard but fun and full of control. we help your team to focus on specific task and control manage and notify on the move of every project progress
                                       
                                  </p>
                              </div>
                              
                         </div>

                         <div class="flex justify-between h-screen bg-[length:50%] bg-no-repeat bg-center items-center" style="background-image:url('../../../images/alxLogo.png')">
                              <div class=" w-1/2">
                                  <h3 class="uppercase text-4xl w-4/5 font-extrabold tracking-widest font-mono">
                                        be visible on the internet  
                                  </h3> 
                                  <p class="mt-5  text-gray-600 w-4/5 indent-6">
                                       ALX community will help you to be bold and visible on the internet by show casing your projects and team.  this will help you to build your carrare on the stoned mountan in the digital world . 
                                       
                                  </p>
                              </div>
                              <div class="w-1/2">
                                   <img src="../../../public/images/eye.png" alt="">
                              </div>
                         </div>

                         <div class="flex justify-between h-screen bg-[length:50%] bg-no-repeat bg-center items-center" style="background-image:url('../../../images/alxLogo.png')">
                              
                              <div class="w-1/2">
                                   <img src="../../../public/images/inspiration.svg" alt="">
                              </div>
                              <div class=" w-1/2">
                                  <h3 class="uppercase text-4xl w-4/5 font-extrabold tracking-widest font-mono">
                                        let us be inspired by your projects or read someone inspired blog post
                                  </h3> 
                                  <p class="mt-5  text-gray-600 w-4/5 indent-6">
                                      We get inspired by reading blog posts about someone's failure or success on the road.  As a community, we write our success and failure stories so that others can learn from the downs and the ups of our journey. 
                                        ALX community equipped with a powerful blog posts to make learning easy and fun  
                                       
                                  </p>
                              </div>
                              
                         </div>
                    </div>
           </div>
      </app-layout>
           <footer class=" sticky bottom-0 h-screen gap-y-20 bg-gray-200 -z-20 flex flex-col  justify-center   bg-[length:50%] bg-no-repeat bg-center items-center" style="background-image:url('../../../images/alxLogo.png')">
               <div class="flex gap-x-56">
             
               <div class="flex flex-col gap-y-3 tracking-widest text-gray-600">
                    <h3 class=" font-mono text-xl font-bold">Our network</h3>
                     <Link href="/teams"> alx community </Link>
                     <Link href="/blogs"> alx ethiopia </Link>
                     <Link href="/popular"> alx offical </Link>
                     <Link href="github.com"> github </Link>
               </div>   
               <div class="flex flex-col gap-y-3 tracking-widest text-gray-600">
                    <h3 class=" font-mono text-xl font-bold">Site Links</h3>
                     <Link href="/teams"> Teams </Link>
                     <Link href="/blogs"> blogs </Link>
                     <Link href="/popular"> Popular </Link>
                     <Link href="/alx_risings"> alx risings </Link>
               </div>   
               <div class="flex flex-col gap-y-3 tracking-widest text-gray-600">
                    <h3 class=" font-mono text-xl font-bold">About Us</h3>
                   <Link href="/about"> About Us </Link>
                    <Link href="/alxteam">Our Team </Link>
                    <Link href="/blog"> Our Blog</Link>
                    <Link href="/contact"> Contact Us</Link>
               </div>
                      
               </div>
               <div class="border-b inline-flex  justify-center items-center gap-6">
                    <span> <img class="w-28" src="../../../public/images/logo3.png" alt=""> </span>
                    <h3 class="text-7xl font-extrabold  tracking-widest text-sky-600"> <span class="text-black"> ALX </span> COMMUNITY </h3>
               </div>   
          </footer>
</template>

<script>
   import { Head, Link } from '@inertiajs/inertia-vue3';
    import { defineComponent } from 'vue'
    import AppLayout from '../Layouts/AppLayout.vue'
    export default defineComponent({
         props: ['teams'],
        components: {
            AppLayout,
            Head,
            Link
        },
     
    })
</script>