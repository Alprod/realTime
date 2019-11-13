<template>
<div class="d-flex justify-content-end border-bottom">
    <p class="m-2" @click="addReaction('hearts')"><font-awesome-icon class="icones1" :icon="['fas', 'grin-hearts']" size="3x"/><span>{{ hearts }}</span></p>
    <p class="m-2" @click="addReaction('stars')"><font-awesome-icon class="icones2" :icon="['fas', 'grin-stars']" size="3x"/><span>{{ stars }}</span></p>
    <p class="m-2" @click="addReaction('tears')"><font-awesome-icon class="icones3" :icon="['fas', 'angry']" size="3x" /><span>{{ tears }}</span></p>
</div>
</template>
<script>
export default {
    props: {sessionId: {type: String, required: true}},
    data(){
       return { 
            hearts: 0,
            stars: 0,
            tears: 0,
            reactions: []
        };

    },
    created(){},
    methods: {
        addReaction(type) {
            fetch('api/reactions', {
                methode: 'POST',
                headers: {'Content-type': 'application/ls+json'},
                body: JSON.stringify({session: `/api/session/${this.sessionId}`, type})
            })
            .then(({ok, statusText}) => {
                if(!ok) alert(statusText);
            });
        }
    }

    
}
</script>