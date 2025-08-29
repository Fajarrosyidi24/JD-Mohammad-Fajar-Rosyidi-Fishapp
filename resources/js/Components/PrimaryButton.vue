<template>
    <button
        class="inline-flex items-center justify-center px-6 py-3 
               rounded-xl font-semibold text-white text-sm 
               bg-gradient-to-r from-indigo-600 to-blue-500 
               shadow-md hover:shadow-lg 
               transform transition-all duration-200 
               hover:scale-105 hover:brightness-110 
               focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 
               dark:from-indigo-500 dark:to-blue-400 dark:text-gray-50"
    >
        <slot />
    </button>
</template>
