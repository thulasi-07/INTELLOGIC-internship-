<!-- 14-05-2025
EX1. -->
<!-- <template>
  <div style="padding: 20px;">
    <h1>Hello, Vue Beginner </h1>

    <input v-model="name" placeholder="Enter your name" />
    <p>Welcome, {{ name || 'Guest' }}!</p>

    <h2>My Favorite Fruits </h2>
    <ul>
      <li v-for="(fruit, index) in fruits" :key="index">{{ fruit }}</li>
    </ul>

    <HelloUser :user="name" />
  </div>
</template>

<script>
import HelloUser from './components/HelloUser.vue';

export default {
  name: 'App',
  components: {
    HelloUser
  },
  data() {
    return {
      name: '',
      fruits: ['Apple', 'Banana', 'Mango']
    };
  }
};
</script> -->

<!-- 15-05-2025
EX2. -->
<!-- <template>
  <div>
    <UserInput />
  </div>
</template>

<script>
import UserInput from './components/UserInput.vue'

export default {
  name: 'App',
  components: {
    UserInput
  }
}
</script>

<style>
body {
  font-family: sans-serif;
}
</style> -->



<!-- EX3. -->
<!-- <template>
  <div>
    <ColorBox />
  </div>
</template>

<script>
import ColorBox from './components/ColorBox.vue'

export default {
  name: 'App',
  components: {
    ColorBox
  }
}
</script> -->


<!-- EX4. -->
<!-- <template>
  <div>
    <ComputedExample />
  </div>
</template>

<script>
import ComputedExample from './components/ComputedExample.vue'

export default {
  name: 'App',
  components: {
    ComputedExample
  }
}
</script> -->


<!-- EX5. -->
 <!-- <template>
  <div>
    <WatcherExample />
  </div>
</template>

<script>
import WatcherExample from './components/WatcherExample.vue'

export default {
  name: 'App',
  components: {
    WatcherExample
  }
}
</script> -->


<!-- 16-05-2025
EX6. -->
<!-- <template>
  <div>
    <StudentForm />
  </div>
</template>

<script>
import StudentForm from '../src/Studentform.vue';

export default {
  components: {
    StudentForm
  }
}
</script> -->

<!-- 19-05-2025
EX7. -->
<template>
  <ApplicationForm/>
</template>

<script>




import ApplicationForm from './components/ApplicationFormComp.vue';


export default {
  name: 'App',
  components: {
    ApplicationForm
  }
};
</script>

<style>
body {
  margin: 0;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
</style>


