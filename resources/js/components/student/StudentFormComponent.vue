<template>
  <div class="wrap">
    <el-card class="box-card">
      <div class="card-header">
            <el-page-header @back="goBack" :content="`Student - ${scope}`">
            </el-page-header>
      </div>

      <div>
          <el-form :model="model" :rules="rules" ref="studentForm">
              <el-column >
                <el-form-item label="Name" required prop="name" style="margin-top: 20px;"></el-form-item>
                <el-input v-model="model.name" placeholder="Enter your name" style="margin-top: -35px;"></el-input>

                <el-form-item label="Email" required prop="email" style="margin-top: 10px;"></el-form-item>
                <el-input v-model="model.email" placeholder="Enter your email" style="margin-top: -35px;"></el-input>
                
                <el-form-item label="Class" required prop="class" style="margin-top: 10px;"></el-form-item>
                <el-input v-model="model.class" placeholder="Enter your class" style="margin-top: -35px;"></el-input>

                <el-form-item label="Section" required prop="section" style="margin-top: 10px;"></el-form-item>
                <el-input v-model="model.section" placeholder="Enter your section"  style="margin-top: -35px;"> </el-input>
              </el-column>

              <el-row :guuter="10" >
                <el-form-item style="margin-top: 20px">
                    <el-button type="success" @click="saveForm('studentForm')">Save student</el-button>
                </el-form-item>
              </el-row>

              <div class="message" v-if="this.$store.state.message">{{ this.$store.state.message }}</div>
          </el-form>
      </div>

    </el-card>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'student-form-component',

  props: {
    scope: String,
    id:Number
  },

  data() {
    return {
      model: {
        name: "",
        class: "",
        section: "",
        email: "",
      }
    }
  },

  methods: {
    goBack() {
      window.location.href="/students"
    },

    saveForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          switch (this.scope) {
            case 'create':
              this.$store.dispatch('saveStudent', this.model);
              break;

            case 'edit':
              this.$store.dispatch('updateStudent', {id:this.id, model:this.model});
              break;

            default:
              break;
          }
          
        }
      })
    }
  },

  mounted() {
    switch (this.scope) {
      case 'edit':
        axios.get(`/fetch-student-showbyid/${this.id}`).then(res => {
          // console.log(res.data.data)
          this['model'] = res.data.data
        });

        break;

      default:
        break;
    }
  }
}
</script>

<style scoped>
.wrap{
  display: flex;
  justify-content: center;
  align-items: center;
}

.card-header {
  display: flex;
  justify-content: center;
  align-items: center;
}

.box-card {
  width: 600px;
}

.message{
  text-align: center;
  margin-top: 20px;
  border: none;
  color: #67c23a;
}
</style>