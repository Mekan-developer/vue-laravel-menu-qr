<template>
  <div class="flex items-center justify-center w-full h-[100vh]">
    <div class="text-[56px] font-bold text-[var(--mainBlackColor)]">
        <div class="flex flex-col items-center justify-center">
            <span>404</span>
            <p>PAGE NOT FOUND</p>
            <RouterLink class="text-[#13439b] text-[48px] font-semibold" :to="{name:'menu.index'}">go to menu</RouterLink>
        </div>
        
    </div>
</div>
</template>

<script>
import { RouterLink } from 'vue-router';



</script>