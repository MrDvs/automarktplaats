<template>
	<div class="div">
		<li class="list-group-item"><slot></slot></li>
		<small class="badge float-right">Ik</small>
	</div>
</template>

<script>
	export default {

		mounted() {
			console.log('component mounted.')
		}
	}
</script>
