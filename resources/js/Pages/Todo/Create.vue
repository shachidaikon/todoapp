<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import JetButton from "@/Jetstream/Button.vue";
import JetInputError from "@/Jetstream/InputError";
import Pagination from "@/Components/Pagination"
import { useForm } from '@inertiajs/inertia-vue3'

defineProps({
    todos: Array,
    errors: Object,
    links: Array,
});
</script>

<template>
    <AppLayout title="TodoCreate">
        <template #header>
            <h2 class="font-semibold text-lg text-gray-600 leading-tight">
                習慣化アプリ
            </h2>
        </template>


 

        <label for="my-modal-6" class="btn modal-button">open modal</label>

        <!-- Put this part before </body> tag -->
        <input id="my-modal-6" type="checkbox" class="modal-toggle">
        <div class="modal modal-bottom sm:modal-middle">
          <div class="modal-box">
            <h3 class="font-bold text-lg">Congratulations random Interner user!</h3>
            <p class="py-4">You've been selected for a chance to get one year of subscription to use Wikipedia for free!</p>
            <div class="modal-action">
              <label for="my-modal-6" class="btn">Yay!</label>
            </div>
          </div>
        </div>

        <div class="back">[<a href="/">back</a>]</div>
    </AppLayout>
</template>

<script>
    export default {
        components: {
          Pagination
        },
        data() {
          return {

            form: useForm({
                title: null,
                content: null,
                is_checked: null,
            }),
          }
        },
        methods: {
          updateCheck: function (todo, id) {
            axios.put("/todos/" + id + "/check" , {
              title: todo.title,
              content: todo.content,
              is_checked: todo.is_checked,
            });
          },

           
        }
    }
</script>