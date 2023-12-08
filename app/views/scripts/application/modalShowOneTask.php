
<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
        <!-- Modal content -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>;
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:max-w-3xl">         
            <div class="bg-gray-50 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">                
                <div class="border border-black rounded-md p-2 mb-2">
        <div class="flex mb-2">
            <div class="w-1/5 ml-2 bg-orange-300 rounded-md p-1 text-center">
                <label class="font-bold">Created by</label><br>
                <label class="w-full"><?php echo " " . ($task['task_created_by']); ?></label><br>
                <label class="w-full"><?php echo " " . ($task['task_creation_date']); ?></label>
            </div>
            <div class="w-3/5 ml-2">
                <label hidden>Task ID: <?php echo $task['task_id']; ?> </label>
                <label hidden class="block w-full text-center font-bold text-orange-400"><?php echo strtoupper($task['task_name']); ?></label>
                <div class="w-full ml-auto mt-2">
                    <label class="w-2/5 text-center"><strong>Deadline:</strong> <?php echo($task['task_deadline']); ?></label>
                    <label class="w-1/5 ml-40 text-center"><?php echo($task['task_status']); ?></label>
                </div>
            </div>
            <div class="w-1/5 ml-2">
                <div class="ml-2 bg-orange-300 rounded-md p-1 text-center">
                    <label>Assigned to</label><br>
                    <label class="block w-full font-bold"><?php echo " " . ($task['task_assigned_to']); ?></label>
                </div>
            </div>
        </div>
        <div class="flex mb-2 ">
            <label class="border border-gray-300 rounded-md p-2 block w-full "><?php echo $task['task_details']; ?></label>
        </div>
    </div>
    </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="toggleModal('task-<?php echo $task['task_id']; ?>')">
                    Cerrar
                </button>
            </div>
        </div>
</div>