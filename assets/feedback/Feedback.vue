 <!-- assets/feedback/Feedback.vue-->

 <template>
   <div>
       <ul class="mt-4" v-if="feedback.length">
           <li class="border-bottom pt-4 pb-3" v-for="f in feedback" :key="f['@id']">
               {{ f.author }}
               <star-rating :rating="f.rating" :read-only="true" :star-size="30"></star-rating>
               {{ f.comment }}
           </li>
       </ul>
       <p v-else>Désolé pas de feedback...</p>

       <p v-if="sent">Merci d'avoir évalué cette conférence</p>
       <form class="from-group" v-else @submit.prevent="onSubmit">
           <input class="form-control" v-model="author" name="author" placeholder="author">
           <star-rating class="mt-4 mb-4" v-model="rating" :star-size="30" inactive-color="#dfe4ea" active-color="#ff6b81"></star-rating>
           <textarea class="form-control" v-model="comment" name="comment" cols="30" rows="10" placeholder="Votre message"></textarea>
           <input class="btn btn-primary mt-4 mb-4" :disabled="!author || !rating || !comment" type="submit" value="Envoyer">
       </form>
   </div>
 </template>
 
 <script>
  export default {
      props: {sessionId: {type: String, required: true}},
      data() {
          return {feedback: [], author: '', rating: 0, comment: '', sent: false};
      },
      created(){
          this.fetchFeedback();
      },
      methods: {
          fetchFeedback() {
              fetch(`/api/sessions/${this.sessionId}/feedback`)
                .then(response => response.json())
                .then(data => this.feedback = data['hydra:member'])
          },
          onSubmit() {
              const {sessionId, author, rating, comment} = this;
              fetch('/api/feedback', {
                  method: 'POST',
                  headers: {'Content-type': 'application/ld+json'},
                  body: JSON.stringify({session: `/api/sessions/${sessionId}`, author, rating, comment})
              })
              .then(({ok, statusText}) => {
                  if (!ok) {
                      alert(statusText);
                      return;
                  }
                  this.sent = true;
                  this.fetchFeedback();
              });
          }
       }
    } 
 </script>
 
 <style scoped></style>