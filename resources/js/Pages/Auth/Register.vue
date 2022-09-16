<template>
    <Head title="Register" />

    <jet-authentication-card>
        <template #logo >
            <div class="flex flex-col">
            <alx-logo :avatar="form.profile_picture" />
            <div  class="uppercase  mt-4 text-center text-gray-500  font-bold ">
               <span v-if="step == 0">
                use your alx crediental to login   
                </span> 
              <span v-if="step == 1" class="text-red-700">
                 account linked successfuly <br>
              </span>
              <span v-if="step == 1">
                 create new password
              </span>
            </div>
            </div>
        </template>

        <jet-validation-errors class="mb-4" />
        <form @submit.prevent="alxchecker" v-if="step == 0">
             
            <div class="mt-4">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="alx_form.email" required />
            </div>

            <div class="mt-4">
                <jet-label for="password" value="Password" />
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="alx_form.password" required autocomplete="new-password" />
            </div>
             <div class="mt-4">
                <jet-label for="apiKey" value="ALX api key" />
                <jet-input id="apiKey" type="text" class="mt-1 block w-full" v-model="alx_form.api_key" required autocomplete="alx-api-key" />
            </div>
            <div class="mt-4 flex justify-between ">

              <jet-button @click="alxchecker()" class="ml-4" :class="{ 'opacity-25': alx_form.processing }" :disabled="alx_form.processing">
                    Next
                </jet-button>
                <a :href="route('login')" class=" text-gray-600 underline">Already have an account</a>
            </div>
        </form>
        <form @submit.prevent="submit" v-if="step == 1">
            
            <div v-if="form.name == ''">
                <jet-label for="name" value="Name" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4" v-if="form.email == ''">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
            </div>

            <div class="mt-4">
                <jet-label for="password" value="Password" />
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <jet-label for="password_confirmation" value="Confirm Password" />
                <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                <jet-label for="terms">
                    <div class="flex items-center">
                        <jet-checkbox name="terms" id="terms" v-model:checked="form.terms" />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                        </div>
                    </div>
                </jet-label>
            </div>

            <div class=" relative flex items-center justify-end mt-4">
                <jet-button @click="step--" class="absolute left-0 bg-slate-500" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Back
                </jet-button>

                <a :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </a>

                <jet-button @click="submit()" class="ml-0" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </jet-button>
            </div>
        </form>
    </jet-authentication-card>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import AlxLogo from '@/Ui/ALXLogo.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import { Head, usePage } from '@inertiajs/inertia-vue3';



    export default defineComponent({
        components: {
            Head,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            AlxLogo
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    name: '',
                    github_username: '',
                    linkedin_url: '',
                    profile_picture: '',
                    nickname: '',
                    twitter_username: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                }),
                alx_form: {
                    email:'',
                    password:'',
                    api_key:'',
                    scope:'checker'
                },
                step:0
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            },

            alxchecker() {
               axios
                    .post('https://alx-intranet.hbtn.io/users/auth_token.json', this.alx_form).then(res => {
                        axios.get('https://alx-intranet.hbtn.io/users/me.json', {params: {auth_token: res.data.auth_token}})
                        .then(
                            data => {
                                this.form.email = data.data.email
                                this.form.name = data.data.full_name
                                this.form.github_username = data.data.github_username
                                this.form.linkedin_url = data.data.linkedin_url
                                this.form.profile_picture = data.data.profile_pic
                                this.form.nickname = data.data.preferred_name_staff
                                this.form.twitter_username = data.data.twitter_username
                                this.step = 1
                            }
                        ).catch( function (error) {
                            usePage().props.value.errors = {unknownError: error.response.data.error}
                        })
                    }).catch( function (error) {
                            usePage().props.value.errors = {usernameOrpassword: error.response.data.error}
                        })
            }
        }
    })
</script>
