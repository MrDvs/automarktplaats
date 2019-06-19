<template>
	<!-- <div class="div">
		<li class="list-group-item"><slot></slot></li>
		<small class="badge float-right">Ik</small>
	</div> -->
	<div class="outgoing_msg">
      <div class="sent_msg">
        <p><slot></slot></p>
        <span class="time_date"></span> </div>
    </div>
</template>

<script>
	export default {

		mounted() {
			console.log('component mounted.')
		}
	}
</script>
