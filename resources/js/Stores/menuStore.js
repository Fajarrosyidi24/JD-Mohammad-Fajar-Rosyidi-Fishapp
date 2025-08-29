import { defineStore } from 'pinia';
import axios from 'axios';

export const useMenuStore = defineStore('menu', {
    state: () => ({
        menus: [],
        user: null,
        roleName: '',
        loaded: false
    }),

    getters: {
        getMenus: (state) => state.menus,
        getRoleName: (state) => state.roleName,
        getUser: (state) => state.user,
        activeMenus: (state) => state.menus.filter(menu => menu.active),
    },

    actions: {
        async fetchMenus() {
            if (this.loaded) return;
            try {
                const response = await axios.get(route('get.menus'));
                this.menus = response.data.menus;
                this.user = response.data.user;
                this.roleName = response.data.roleName;
                this.loaded = true;
            } catch (error) {
                console.error('Failed to fetch menus', error);
            }
        },

        resetMenus() {
            this.menus = [];
            this.user = null;
            this.roleName = '';
            this.loaded = false;
        }
    }
});
