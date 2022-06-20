<template> 
  <!-- Display an input field and a send button. -->
  <div class="input-group">
    <!-- Input Field -->
    <input
      id="btn-input"
      type="text"
      name="message"
      class="form-control input-sm"
      placeholder="Type your message here..."
      v-model="newMessage"
      @keyup.enter="sendMessage" 
      @keydown="isTyping"
    />
    <!--  Call sendMessage() when the enter key is pressed. -->
    <!-- Button -->
    <span class="input-group-btn">
      <!-- Call sendMessage() this button is clicked. -->
      <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
        Send
      </button>

      <VueButtonSpinner
    	@click.native="onClick"
			v-bind="{isLoading, status}"
			:disabled="isLoading"
    >
    <span>Submit</span>
</VueButtonSpinner>




    </span>
    {{isLoading}}
    <div v-show = "isLoading" >
    <ThreeDots></ThreeDots>
    </div>
  </div>
  
</template>
<script>
import {ThreeDots} from 'vue-loading-spinner';
import VueButtonSpinner from 'vue-button-spinner';
export default {
  components: {
    ThreeDots,
    VueButtonSpinner
},
  //Takes the "user" props from <chat-form> … :user="{{ Auth::user() }}"></chat-form> in the parent chat.blade.php.
  props: ["user"],
  data() {
    return {
      newMessage: "",
      statusMessage: 'Try me!',
      isLoading: false,
			status: '',
    };
  },
  created(){
      this.isLoading = true;
            //POST request to the messages route with the message data in order for our Laravel server to broadcast it.
            axios.post('https://jsonplaceholder.typicode.com/comments')
            .then(response => {
                console.log(response.data);
            })
            .finally(() => {
                this.isLoading = false; // hide the loading screen
                console.log('finally');
              })
  },
  methods: {
    sendMessage() {
      //Emit a "messagesent" event including the user who sent the message along with the message content
      this.$emit("messagesent", {
        user: this.user,
      //newMessage is bound to the earlier "btn-input" input field
        message: this.newMessage,
        
      });
      //Clear the input
      this.newMessage = "";
    },

    isTyping() {
            let channel = Echo.private('chat');
          
            setTimeout(function() {
              channel.whisper('typing', {
                user:Laravel.user,
                typing: true,
              });
            }, 300);
          },


    onClick () {
			this.isLoading = true
			this.statusMessage = 'Sending request to get a random response...'
			setTimeout(() => {
				this.isLoading = false
				this.status = Math.random() >= 0.5;
				this.statusMessage = this.status 
					? 'Request successful!' 
					: 'Request failed'
				this.clear()
			}, 2000)
		},
		clear () {
        setTimeout(() => {
          this.statusMessage = 'Try again :)'
          this.status = ''
        }, 1600)
      }
    
  },


 
};
</script>
