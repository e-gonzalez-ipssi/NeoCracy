<template>
  <div v-if="revele" class="bloc-modale">
    <div class="overlay" @click="toggleModaleSuccess"></div>
    <div class="modale">
      <button class="btn-modale" @click="toggleModaleSuccess">X</button>
      <h2>Success</h2>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModaleSuccess',
  props: {
    revele: Boolean,
    toggleModaleSuccess: { type: Function, required: true },
  },
  methods: {
    toggleModaleSuccess() {
      this.reveleSuccess = !this.reveleSuccess
    },
    toggleModaleFail() {
      this.reveleFail = !this.reveleFail
    },
  }
}
</script>

<style scoped>
.bloc-modale {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  display: flex;
  justify-content: center;
  align-items: center;
}

.overlay {
  background: rgba(0, 0, 0, 0.5);
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
}

.modale {
  background: #f1f1f1;
  color: #333;
  padding: 50px;
  position: fixed;
  top: 30%;
}

.btn-modale {
  position: absolute;
  top: 10px;
  right: 10px;
}
</style>
