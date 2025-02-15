<template>
    <form-field
        :name="name"
        :label="label"
        :label-for="id"
        :help="help"
        :required="required"
        :disabled="disabled"
        :locale="locale"
    >
        <div
            v-if="editor"
            class="flex flex-col w-full overflow-hidden bg-white border border-inherit max-h-[75vh] min-h-72 resize-y"
        >
            <editor-toolbar
                :editor="editor"
                class="sticky top-0 z-10 shrink-0"
            />

            <editor-content :editor="editor" class="flex-1 overflow-x-scroll" />
        </div>
    </form-field>
</template>

<script>
    import { useEditor, EditorContent } from '@tiptap/vue-3';
    import Blockquote from '@tiptap/extension-blockquote';
    import Bold from '@tiptap/extension-bold';
    import BulletList from '@tiptap/extension-bullet-list';
    import Document from '@tiptap/extension-document';
    import { Color } from '@tiptap/extension-color';
    import Dropcursor from '@tiptap/extension-dropcursor';
    import Gapcursor from '@tiptap/extension-gapcursor';
    import HardBreak from '@tiptap/extension-hard-break';
    import Heading from '@tiptap/extension-heading';
    import Highlight from '@tiptap/extension-highlight';
    import History from '@tiptap/extension-history';
    import HorizontalRule from '@tiptap/extension-horizontal-rule';
    import Image from '@tiptap/extension-image';
    import Italic from '@tiptap/extension-italic';
    import Link from '@tiptap/extension-link';
    import ListItem from '@tiptap/extension-list-item';
    import OrderedList from '@tiptap/extension-ordered-list';
    import Paragraph from '@tiptap/extension-paragraph';
    import Strike from '@tiptap/extension-strike';
    import Subscript from '@tiptap/extension-subscript';
    import Superscript from '@tiptap/extension-superscript';
    import Table from '@tiptap/extension-table';
    import TableCell from '@tiptap/extension-table-cell';
    import TableHeader from '@tiptap/extension-table-header';
    import TableRow from '@tiptap/extension-table-row';
    import Text from '@tiptap/extension-text';
    import TextAlign from '@tiptap/extension-text-align';
    import TextStyle from '@tiptap/extension-text-style';
    import Typography from '@tiptap/extension-typography';
    import Underline from '@tiptap/extension-underline';

    import { defineInput } from '@/helpers';
    import { watch } from 'vue';

    export default defineInput({
        name: 'FormEditor',
        components: {
            EditorContent,
        },
        props: {
            minHeight: {
                type: Number,
                default: 90,
            },
            maxHeight: {
                type: Number,
                default: null,
            },
        },
        setup(props, { emit }) {
            watch(
                () => props.modelValue,
                (modelValue) => {
                    if (editor.value.getHTML() === modelValue) {
                        return;
                    }

                    editor.value.commands.setContent(modelValue);
                }
            );

            const editor = useEditor({
                extensions: [
                    Blockquote,
                    Bold,
                    BulletList,
                    Color,
                    Document,
                    Dropcursor,
                    Gapcursor,
                    HardBreak,
                    Heading,
                    Highlight,
                    History,
                    HorizontalRule,
                    Image,
                    Italic,
                    Link.configure({ openOnClick: false }),
                    ListItem,
                    OrderedList,
                    Paragraph,
                    Strike,
                    Subscript,
                    Superscript,
                    Table.configure({ resizable: false }),
                    TableCell,
                    TableHeader,
                    TableRow,
                    Text,
                    TextAlign.configure({ types: ['heading', 'paragraph'] }),
                    TextStyle,
                    Typography,
                    Underline,
                ],
                editorProps: {
                    attributes: {
                        class: `prose prose-blue px-4 py-5 min-h-32 focus:outline-none`,
                    },
                },
                content: props.modelValue || '',

                onUpdate({ editor }) {
                    emit('update:modelValue', editor.getHTML());
                },
            });

            return {
                editor,
            };
        },
    });
</script>

<style lang="postcss">
    .ProseMirror {
        table {
            .selectedCell {
                @apply after:absolute after:inset-0 after:z-10 after:pointer-events-none;
                @apply after:bg-blue-400/30;
            }

            .column-resize-handle {
                @apply absolute -right-0.5 -bottom-0.5 top-0 w-1 pointer-events-none;
                @apply bg-blue-400;
            }
        }

        &.resize-cursor {
            cursor: ew-resize;
            cursor: col-resize;
        }
    }
</style>
