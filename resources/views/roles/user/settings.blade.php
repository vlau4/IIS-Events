<x-layout>
    <div class="flex flex-col items-center justify-center text-center">        
        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-rose-800 hover:bg-rose-900 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
            DELETE ACCOUNT
        </button>

        <x-popup-modal :question="'Are you sure you want to delete the account?'" :warrning="'This action cannot be undone!'" :answ1="'Delete'" :answ2="'Cancel'"/>
    </div>
</x-layout>