<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/Pagination";
import JetDropdown from '@/Jetstream/Dropdown.vue';
import JetDropdownLink from '@/Jetstream/DropdownLink.vue';
defineProps({
    todos: Array,
    errors: Object,
    links: Array,
});
</script>
<template>
    <AppLayout>
        <template #header>
            <h2 class="font-medium text-xl text-gray-800 leading-tight">
                Habit bot
            </h2>
        </template>

        <div class="pt-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">            
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4"
                >
                <!-- flashメッセージ -->
                    <div
                        v-if="$page.props.flash.message"
                        class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mx-5 my-3"
                        role="alert"
                    >
                        <div class="flex">
                            <div>
                                <p class="text-sm">
                                    {{ $page.props.flash.message }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div
                        v-if="$page.props.flash.error"
                        class="bg-red-100 border-t-4 border-red-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3 mx-5"
                        role="alert"
                    >
                        <div class="flex">
                            <div>
                                <div v-if="errors.title" class="text-red-500">
                                    {{ errors.title[0] }}
                                </div>
                                <div v-if="errors.content" class="text-red-500">
                                    {{ errors.content[0] }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- リスト -->
                    <div class="px-4 py-5 rounded-t sm:px-6">
                        <div
                            class="bg-white  shadow overflow-hidden sm:rounded-md"
                        >
                            <ul class="divide-y divide-gray-200">
                                <li v-for="todo in todos.data" :key="todo.id">
                                    <a
                                        class="block hover:bg-gray-50 "
                                    >
                                        <div
                                            class="px-4 py-4 rounded-md sm:px-6"
                                        >
                                            <div class="grid grid-cols-4 gap-4">
                                                <label>
                                                    <input
                                                        v-model="
                                                            todo.is_checked
                                                        "
                                                        :name="todo.id"
                                                        type="checkbox"
                                                        class="checkbox checkbox-xs checkbox-primary"
                                                        @change="
                                                            updateCheck(
                                                                todo,
                                                                todo.id
                                                            )
                                                        "
                                                    />
                                                </label>
                                                <p
                                                    class="text-md text-gray-700 md:truncate col-span-2"
                                                    :class="{
                                                        'line-through':
                                                            todo.is_checked,
                                                    }"
                                                >
                                                    {{ todo.title }}
                                                </p>

                                                <!-- 削除,編集用ドロップダウン -->
                                                <JetDropdown align="right" width="48" class="flex flex-row-reverse">
                                                    <template #trigger>
                                                        <span class="inline-flex rounded-md">
                                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">

                                                                <svg
                                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20"
                                                                    fill="currentColor"
                                                                >
                                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                </svg>
                                                            </button>
                                                        </span>
                                                    </template>

                                                    <template #content>
                                                        <JetDropdownLink as="button" @click="edit(todo)">
                                                            編集
                                                        </JetDropdownLink>

                                                        <JetDropdownLink as="button" @click="deleteRow(todo)">
                                                            削除
                                                        </JetDropdownLink>
                                                    </template>
                                                </JetDropdown>

                                                <!-- 位置調整の空div -->
                                                <div></div>

                                                <!-- 詳細 -->
                                                <div class="col-span-2">
                                                    <p
                                                        class="text-md font-light text-gray-500"
                                                        :class="{
                                                            'line-through':
                                                                todo.is_checked,
                                                        }"
                                                    >
                                                        {{ todo.content }}
                                                    </p>
                                                </div>
                                                <!-- 継続時間 -->
                                                <div
                                                    class="ml-2 flex flex-row-reverse"
                                                >
                                                    <p
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                                                        :class="{
                                                            'line-through':
                                                                todo.is_checked,
                                                        }"
                                                    >
                                                        継続時間
                                                    </p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <pagination class="mt-6 px-4" :links="todos.links" />

                    <!-- ページネーション用リンク -->

                    <!-- 作成と編集用モーダル -->
                    <div
                        v-if="isOpen"
                        class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400 animate-fade-in-up" 
                    >
                        <div
                            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
                        >
                            <div class="fixed inset-0 transition-opacity">
                                <div
                                    class="absolute inset-0 bg-gray-500 opacity-75"
                                ></div>
                            </div>
                            <!-- This element is to trick the browser into centering the modal contents. -->
                            <span
                                class="hidden sm:inline-block sm:align-middle sm:h-screen"
                            ></span
                            >​
                            <div
                                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                                role="dialog"
                                aria-modal="true"
                                aria-labelledby="modal-headline"
                            >
                                <form>
                                    <div
                                        class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4"
                                    >
                                        <div class="">
                                            <div class="mb-4">
                                                <label
                                                    for="exampleFormControlInput1"
                                                    class="block text-gray-700 text-sm font-bold mb-2"
                                                    >やること:</label
                                                >
                                                <input
                                                    id="exampleFormControlInput1"
                                                    v-model="form.title"
                                                    type="text"
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    placeholder="やることを入力してください"
                                                />
                                                <!-- <JetInputError :message="form.errors.title" class="mt-2 text-red-500"/> -->
                                            </div>
                                            <div class="mb-4">
                                                <label
                                                    for="exampleFormControlInput2"
                                                    class="block text-gray-700 text-sm font-bold mb-2"
                                                    >詳細:</label
                                                >
                                                <textarea
                                                    id="exampleFormControlInput2"
                                                    v-model="form.content"
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    placeholder="やることの詳細を入力してください"
                                                ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
                                    >
                                        <span
                                            class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto"
                                        >
                                            <button
                                                v-show="!editMode"
                                                wire:click.prevent="store()"
                                                type="button"
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-shine-muscat text-base leading-6 font-medium text-white shadow-sm hover:bg-baby-leaf focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                                @click="save(form)"
                                            >
                                                保存
                                            </button>
                                        </span>
                                        <span
                                            class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto"
                                        >
                                            <button
                                                v-show="editMode"
                                                wire:click.prevent="store()"
                                                type="button"
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-shine-muscat text-base leading-6 font-medium text-white shadow-sm hover:bg-baby-leaf focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                                @click="update(form)"
                                            >
                                                更新
                                            </button>
                                        </span>
                                        <span
                                            class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto"
                                        >
                                            <button
                                                type="button"
                                                class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                                @click="closeModal()"
                                            >
                                                キャンセル
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 py-5">
            <button
                class="btn-circle bg-shine-muscat shadow-lg h-16 w-16 hover:bg-baby-leaf text-2xl text-white font-black py-2 px-4 my-3 transition"
                @click="openModal()"
            >
                +
            </button>
        </div>
    </AppLayout>
</template>
<script>
export default {
    components: {
        Pagination,
    },
    data() {
        return {
            CreateMode: false,
            editMode: false,
            isOpen: false,
            form: {
                title: null,
                content: null,
            },
        };
    },
    methods: {
        updateCheck: function (todo, id) {
            console.log(this.todos.data)
            axios.put("/todos/" + id + "/check", {
                title: todo.title,
                content: todo.content,
                is_checked: todo.is_checked,
            });
        },
        openModal: function () {
            console.log(this.todos.links);
            this.isOpen = true;
        },
        closeModal: function () {
            this.isOpen = false;
            this.reset();
            this.editMode = false;
        },
        reset: function () {
            this.form = {
                title: null,
                content: null,
            };
        },
        save: function (data) {
            this.$inertia.post("/todos", data);
            this.reset();
            this.closeModal();
            this.editMode = false;
        },
        edit: function (data) {
            this.form = Object.assign({}, data);
            this.editMode = true;
            this.openModal();
        },
        update: function (data) {
            data._method = "PUT";
            this.$inertia.post("/todos/" + data.id, data);
            this.reset();
            this.closeModal();
        },
        deleteRow: function (data) {
            if (!confirm("本当に削除しますか?")) return;
            data._method = "DELETE";
            this.$inertia.post("/todos/" + data.id, data);
            this.reset();
            this.closeModal();
        },

    },
};
</script>
