<!DOCTYPE html>
<html>
<head>
	<title>Testing Vue</title>
</head>
<body>

<div id="app">
  <table>
    <tr v-for="(actor, key) in actors">
    	<td>@{{ key }}</td>
    	<td>@{{ actor.character }}</td>
    	<td>@{{ actor.name }}</td>
    	<td><button @click="deleteActor(key)">delete</button></td>
    	<td><button @click="displayActor(key)">display</button></td>
    </tr>
  </table>
  <br>
  @{{message}}
  <br>
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<script type="text/javascript">

	var app = new Vue({
	  el: '#app',
	  data: {
	    actors: {!! json_encode($actors) !!},
	    message: 'Hello',
	  },
	  methods: {
	  	deleteActor: function(key){
	  		axios
	  			.delete('/actors/'+key)
	  			.then(this.$delete(this.actors, key));
	  		
	  	},
	  	displayActor: function(key){
	  		axios
	  			.get('/actors/'+key)
	  			.then(response => (this.message = response.data));
	  	}
	  }
	})

</script>

</body>
</html>