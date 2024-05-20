<script>
    //AGENT
    $(document).ready(function() {
    $('#agentlist_agent_id').on('input', function() {
        var agent_id = $(this).val();
        $.ajax({
            url: '<?= site_url('check_agent_id') ?>',
            method: 'POST',
            data: { agent_id: agent_id },
            success: function(response) {
                if (response.exists) {
                    $('#agentlist_agent_id_error').text('Agent ID already exists.');
                    $('#agentlist_updateBtn').prop('disabled', true);
                } else {
                    $('#agentlist_agent_id_error').text('');
                    $('#agentlist_updateBtn').prop('disabled', false);
                }
            }
        });
    });
});




  //CPU
  $(document).ready(function() {
    $('#cpu_equip_id').on('input', function() {
        var cpu_equip_id = $(this).val();
        $.ajax({
            url: '<?= site_url('cpu_check_equip_id/check') ?>',
            method: 'POST',
            data: { cpu_equip_id: cpu_equip_id },
            success: function(response) {
                if (response.exists) {
                    $('#cpu_equip_id_error').text('Equipment ID already exists.');
                    $('#cpusaveBtn').prop('disabled', true);
                } else {
                    $('#cpu_equip_id_error').text('');
                    $('#cpusaveBtn').prop('disabled', false);
                }
            }
        });
    });
});


$(document).ready(function(){
    $('.cpu_agent_dropdown').change(function(){
        var agent_id = $(this).val();
        var row_id = $(this).data('id');
        $.ajax({
            url: '<?= site_url('cpu_check_agentID/update') ?>',
            type: 'POST',
            data: {agent_id: agent_id},
            success: function(response){
                if(response.exists){
                    $('#cpu_agent_id_error_'+row_id).html('Already assigned!');
                    $('#updateCPU_'+row_id).prop('disabled', true);
                } else {
                    $('#cpu_agent_id_error_'+row_id).html('');
                    $('#updateCPU_'+row_id).prop('disabled', false);
                }
            }
        });
    });
});

//HEADSET
$(document).ready(function() {
    $('#headset_equip_id').on('input', function() {
        var headset_equip_id = $(this).val();
        $.ajax({
            url: '<?= site_url('headset_check_equip_id') ?>',
            method: 'POST',
            data: { headset_equip_id: headset_equip_id },
            success: function(response) {
                if (response.exists) {
                    $('#headset_equip_id_error').text('Equipment ID already exists.');
                    $('#headsetsaveBtn').prop('disabled', true);
                } else {
                    $('#headset_equip_id_error').text('');
                    $('#headsetsaveBtn').prop('disabled', false);
                }
            }
        });
    });
});

$(document).ready(function(){
    $('.headset_agent_dropdown').change(function(){
        var agent_id = $(this).val();
        var row_id = $(this).data('id');
        $.ajax({
            url: '<?= site_url('headset/headset_check_agentID') ?>',
            type: 'POST',
            data: {agent_id: agent_id},
            success: function(response){
                if(response.exists){
                    $('#headset_agent_id_error_'+row_id).html('Already assigned!');
                    $('#updateheadset_'+row_id).prop('disabled', true);
                } else {
                    $('#headset_agent_id_error_'+row_id).html('');
                    $('#updateheadset_'+row_id).prop('disabled', false);
                }
            }
        });
    });
});

$('.headset_agent_dropdown').dropdown({
    onChange: function(value, text, $selectedItem) {
        var agentId = value;
        var agentName = $selectedItem.find('span.text').text();
        var formId = $(this).data('id');

        if (value !== "0") {
            $('#headset_agent_name_' + formId).val(agentName);
            $('#headset_agent_fk_id_' + formId).val(agentId);
        } else {
            $('#headset_agent_name_' + formId).val('None');
            $('#headset_agent_fk_id_' + formId).val(0);
        }
    }
});
function headsetEditStatus(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom status:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }

    var status = selectElement.value;
    var agentFkIdInput = $('.headset_agent_fk_id_');
    var agentInput = $('.headset_agent_name_');

    if (status !== 'Assigned' && status !== 'Unassigned') {
        agentFkIdInput.val(""); 
        agentInput.val(""); 
    }
}

$('.form-control#status').change(function() {
    headsetEditStatus(this);
});
//MOUSE

$(document).ready(function() {
    $('#mouse_equip_id').on('input', function() {
        var mouse_equip_id = $(this).val();
        $.ajax({
            url: '<?= site_url('mouse_check_equip_id/check') ?>',
            method: 'POST',
            data: { mouse_equip_id: mouse_equip_id },
            success: function(response) {
                if (response.exists) {
                    $('#mouse_equip_id_error').text('Equipment ID already exists.');
                    $('#mouseSaveBTN').prop('disabled', true);
                } else {
                    $('#mouse_equip_id_error').text('');
                    $('#mouseSaveBTN').prop('disabled', false);
                }
            }
        });
    });
});

$(document).ready(function(){
    $('.mouse_agent_dropdown').change(function(){
        var agent_id = $(this).val();
        var row_id = $(this).data('id');
        $.ajax({
            url: '<?= site_url('mouse_check_agentID') ?>',
            type: 'POST',
            data: {agent_id: agent_id},
            success: function(response){
                if(response.exists){
                    $('#agent_id_error_'+row_id).html('Already assigned!');
                    $('#updatemouse_'+row_id).prop('disabled', true);
                } else {
                    $('#agent_id_error_'+row_id).html('');
                    $('#updatemouse_'+row_id).prop('disabled', false);
                }
            }
        });
    });
});

$('.mouse_agent_dropdown').dropdown({
    onChange: function(value, text, $selectedItem) {
        var agentId = value;
        var agentName = $selectedItem.find('span.text').text();
        var formId = $(this).data('id');

        if (value !== "0") {
            $('#mouse_agent_name_' + formId).val(agentName);
            $('#mouse_agent_fk_id_' + formId).val(agentId);
        } else {
            $('#mouse_agent_name_' + formId).val('None');
            $('#mouse_agent_fk_id_' + formId).val(0);
        }
    }
});
function mousestatusedit(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom status:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }

    var status = selectElement.value;
    var agentFkIdInput = $('.mouse_agent_fk_id_');
    var agentInput = $('.mouse_agent_name_');

    if (status !== 'Assigned' && status !== 'Unassigned') {
        agentFkIdInput.val(""); 
        agentInput.val(""); 
    }
}

$('.form-control#status').change(function() {
    mousestatusedit(this);
});

//KEYBOARD
$(document).ready(function() {
    $('#keyboard_equip_id').on('input', function() {
        var keyboard_equip_id = $(this).val();
        $.ajax({
            url: '<?= site_url('keyboard_check_equip_id') ?>',
            method: 'POST',
            data: { keyboard_equip_id: keyboard_equip_id },
            success: function(response) {
                if (response.exists) {
                    $('#keyboard_equip_id_error').text('Equipment ID already exists.');
                    $('#keyboardSaveBTN').prop('disabled', true);
                } else {
                    $('#keyboard_equip_id_error').text('');
                    $('#keyboardSaveBTN').prop('disabled', false);
                }
            }
        });
    });
});

$(document).ready(function(){
    $('.keyboard_agent_dropdown').change(function(){
        var agent_id = $(this).val();
        var row_id = $(this).data('id');
        $.ajax({
            url: '<?= site_url('keyboard_check_agentID') ?>',
            type: 'POST',
            data: {agent_id: agent_id},
            success: function(response){
                if(response.exists){
                    $('#keybaord_agent_id_error_'+row_id).html('Already assigned');
                    $('#updatekeyboard_'+row_id).prop('disabled', true);
                } else {
                    $('#keybaord_agent_id_error_'+row_id).html('');
                    $('#updatekeyboard_'+row_id).prop('disabled', false);
                }
            }
        });
    });
});

$('.keyboard_agent_dropdown').dropdown({
    onChange: function(value, text, $selectedItem) {
        var agentId = value;
        var agentName = $selectedItem.find('span.text').text();
        var formId = $(this).data('id');

        if (value !== "0") {
            $('#keyboard_agent_name_' + formId).val(agentName);
            $('#keyboard_agent_fk_id_' + formId).val(agentId);
        } else {
            $('#keyboard_agent_name_' + formId).val('None');
            $('#keyboard_agent_fk_id_' + formId).val(0);
        }
    }
});
function keyboardstatusedit(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom status:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }

    var status = selectElement.value;
    var agentFkIdInput = $('.keyboard_agent_fk_id_');
    var agentInput = $('.keyboard_agent_name_');

    if (status !== 'Assigned' && status !== 'Unassigned') {
        agentFkIdInput.val(""); 
        agentInput.val(""); 
    }
}

$('.form-control#status').change(function() {
    keyboardstatusedit(this);
});



//MONITOR
$(document).ready(function() {
    $('#monitor_equip_id').on('input', function() {
        var monitor_equip_id = $(this).val();
        $.ajax({
            url: '<?= site_url('monitor_check_equip_id/check') ?>',
            method: 'POST',
            data: { monitor_equip_id: monitor_equip_id },
            success: function(response) {
                if (response.exists) {
                    $('#monitor_equip_id_error').text('Equipment ID already exists.');
                    $('#monitor_saveBtn').prop('disabled', true);
                } else {
                    $('#monitor_equip_id_error').text('');
                    $('#monitor_saveBtn').prop('disabled', false);
                }
            }
        });
    });
});

//MONITOR AGENT
// $(document).ready(function(){
//     // Initialize error states for each input
//     var agentError = false;
//     var firstMonitorError = false;
//     var secondMonitorError = false;

//     $('.monitor_agentadd_dropdown').change(function(){
//         var agent_id = $(this).val();
//         $.ajax({
//             url: '<?= site_url('addagent_monitor_check_agent') ?>',
//             type: 'POST',
//             data: {agent_id: agent_id},
//             success: function(response){
//                 if(response.exists){
//                     $('#add_agent_id_error').html('Already assigned!');
//                     agentError = true;
//                 } else {
//                     $('#add_agent_id_error').html('');
//                     agentError = false;
//                 }
//                 if(agentError || firstMonitorError || secondMonitorError) {
//                     $('#addagent_monitor').prop('disabled', true);
//                 } else {
//                     $('#addagent_monitor').prop('disabled', false);
//                 }
//             }
//         });
//     });

//     $('.firstmonitor_dropdown').change(function(){
//         var monitor_equip_id = $(this).val();
//         $.ajax({
//             url: '<?= site_url('addagent_monitor_one_check') ?>',
//             type: 'POST',
//             data: {monitor_equip_id: monitor_equip_id},
//             success: function(response){
//                 if(response.exists){
//                     $('#add_monitorone_error').html('Already assigned!');
//                     firstMonitorError = true;
//                 } else {
//                     $('#add_monitorone_error').html('');
//                     firstMonitorError = false;
//                 }
//                 // Check if any error is present, then disable the button
//                 if(agentError || firstMonitorError || secondMonitorError) {
//                     $('#addagent_monitor').prop('disabled', true);
//                 } else {
//                     $('#addagent_monitor').prop('disabled', false);
//                 }
//             }
//         });
//     });

//     $('.second_monitor_dropdown').change(function(){
//         var monitor_equip_id = $(this).val();
//         $.ajax({
//             url: '<?= site_url('addagent_monitor_one_check') ?>',
//             type: 'POST',
//             data: {monitor_equip_id: monitor_equip_id},
//             success: function(response){
//                 if(response.exists){
//                     $('#add_monitortwo_error').html('Already assigned!');
//                     secondMonitorError = true;
//                 } else {
//                     $('#add_monitortwo_error').html('');
//                     secondMonitorError = false;
//                 }
//                 if(agentError || firstMonitorError || secondMonitorError) {
//                     $('#addagent_monitor').prop('disabled', true);
//                 } else {
//                     $('#addagent_monitor').prop('disabled', false);
//                 }
//             }
//         });
//     });
// });
// $(document).ready(function(){
//     $('.agent_monitor_agentedit_dropdown, .edit_firstmonitor_dropdown, .edit_second_monitor_dropdown').change(function(){
//         var row_id = $(this).data('id');
//         var agent_id = $('.agent_monitor_agentedit_dropdown[data-id="' + row_id + '"]').val();
//         var first_monitor_id = $('.edit_firstmonitor_dropdown[data-id="' + row_id + '"]').val();
//         var second_monitor_id = $('.edit_second_monitor_dropdown[data-id="' + row_id + '"]').val();

//         $.ajax({
//             url: '<?= site_url('addagent_monitor_check_agent') ?>',
//             type: 'POST',
//             data: { agent_id: agent_id },
//             success: function(response){
//                 if(response.exists){
//                     $('#edit_agent_id_error_'+row_id).html('Already assigned!');
//                     disableButton(row_id);
//                 } else {
//                     $('#edit_agent_id_error_'+row_id).html('');
//                     checkAndUpdateButton(row_id);
//                 }
//             }
//         });

//         $.ajax({
//             url: '<?= site_url('addagent_monitor_one_check') ?>',
//             type: 'POST',
//             data: { monitor_equip_id: first_monitor_id },
//             success: function(response){
//                 if(response.exists){
//                     $('#edit_monitorone_error_'+row_id).html('Already assigned!');
//                     disableButton(row_id);
//                 } else {
//                     $('#edit_monitorone_error_'+row_id).html('');
//                     checkAndUpdateButton(row_id);
//                 }
//             }
//         });

//         $.ajax({
//             url: '<?= site_url('addagent_monitor_one_check') ?>',
//             type: 'POST',
//             data: { monitor_equip_id: second_monitor_id },
//             success: function(response){
//                 if(response.exists){
//                     $('#edit_monitortwo_error_'+row_id).html('Already assigned!');
//                     disableButton(row_id);
//                 } else {
//                     $('#edit_monitortwo_error_'+row_id).html('');
//                     checkAndUpdateButton(row_id);
//                 }
//             }
//         });
//     });
// });

// function disableButton(row_id) {
//     $('#updateagent_monitor_'+row_id).prop('disabled', true);
// }

// function checkAndUpdateButton(row_id) {
//     var agent_error = $('#edit_agent_id_error_'+row_id).html();
//     var first_monitor_error = $('#edit_monitorone_error_'+row_id).html();
//     var second_monitor_error = $('#edit_monitortwo_error_'+row_id).html();

//     if (agent_error || first_monitor_error || second_monitor_error) {
//         disableButton(row_id);
//     } else {
//         $('#updateagent_monitor_'+row_id).prop('disabled', false);
//     }

    
// }
$('.agent_monitor_agent_edit_dropdown').dropdown({
    onChange: function(value, text, $selectedItem) {
        var id = $(this).data('id');
        var prefix = '#monitor_';
        if (text === 'None') {
            $(prefix + 'agent_edit_agent_name_' + id).val('None');
            $(prefix + 'agent_edit_agent_fk_id_' + id).val('0');
        } else {
            $(prefix + 'agent_edit_agent_name_' + id).val($selectedItem.children('.text').text());
            $(prefix + 'agent_edit_agent_fk_id_' + id).val(value);
        }
    }
});

$('.edit_firstmonitor_dropdown').dropdown({
    onChange: function(value, text, $selectedItem) {
        var id = $(this).data('id');
        var prefix = '#edit_';
        if (text === 'None') {
            $(prefix + 'monitor_one_' + id).val('None');
            $(prefix + 'monitor_one_fk_' + id).val('0');
        } else {
            $(prefix + 'monitor_one_' + id).val($selectedItem.children('.text').text());
            $(prefix + 'monitor_one_fk_' + id).val(value);
        }
    }
});

$('.edit_second_monitor_dropdown').dropdown({
    onChange: function(value, text, $selectedItem) {
        var id = $(this).data('id');
        var prefix = '#edit_';
        if (text === 'None') {
            $(prefix + 'monitor_two_' + id).val('None');
            $(prefix + 'monitor_two_fk_' + id).val('0');
        } else {
            $(prefix + 'monitor_two_' + id).val($selectedItem.children('.text').text());
            $(prefix + 'monitor_two_fk_' + id).val(value);
        }
    }
});


    $(document).ready(function() {
        $('.ui.dropdown').dropdown(); // Initialize dropdowns

        $('.ui.dropdown').change(function() {
            var firstMonitorValue = $('.firstmonitor_dropdown input[type="hidden"]').val();
            var secondMonitorValue = $('.second_monitor_dropdown input[type="hidden"]').val();
            var submitButton = $('#addagent_monitor');

            if (firstMonitorValue !== '0' && firstMonitorValue === secondMonitorValue) {
                $('#first_monitor_error').text('Monitor is the same!');
                $('#second_monitor_error').text('Monitor is the same!');
                submitButton.prop('disabled', true); // Disable the button
            } else {
                $('#first_monitor_error').text('');
                $('#second_monitor_error').text('');
                submitButton.prop('disabled', false); // Enable the button
            }
        });
    });


// $(document).ready(function() {
//     $('.ui.dropdown').each(function() {
//         var modalId = $(this).data('id');
//         var firstMonitorDropdown = $('.edit_firstmonitor_dropdown[data-id="' + modalId + '"]');
//         var secondMonitorDropdown = $('.edit_second_monitor_dropdown[data-id="' + modalId + '"]');
//         var submitButton = $('#updateagent_monitor_' + modalId);

//         $(this).dropdown(); // Initialize dropdowns

//         $(this).change(function() {
//             var firstMonitorValue = firstMonitorDropdown.find('input[type="hidden"]').val();
//             var secondMonitorValue = secondMonitorDropdown.find('input[type="hidden"]').val();
//             var firstMonitorError = $('#edit_first_monitor_error_' + modalId);
//             var secondMonitorError = $('#edit_second_monitor_error_' + modalId);

//             if (firstMonitorValue !== '0' && firstMonitorValue === secondMonitorValue) {
//                 firstMonitorError.text('Monitor is the same!');
//                 secondMonitorError.text('Monitor is the same!');
//                 submitButton.prop('disabled', true); // Disable the button
//             } else {
//                 firstMonitorError.text('');
//                 secondMonitorError.text('');
//                 submitButton.prop('disabled', false); // Enable the button
//             }
//         });
//     });
// });




$('.monitor_agentadd_dropdown').dropdown({
    onChange: function(value, text, $selectedItem) {
        $('#monitor_agent_add_agent_name').val($selectedItem.find('.text').text());
        $('#monitor_agent_add_agent_fk_id').val(value);
    }
});

// $('.firstmonitor_dropdown').dropdown({
//     onChange: function(value, text, $selectedItem) {
//         $('#addmonitor_one').val($selectedItem.find('.text').text());
//         $('#addmonitor_one_fk').val(value);
//     }
// });


$('.firstmonitor_dropdown').dropdown({
    onChange: function(value, text, $selectedItem) {
        if (text === 'None') {
            $('#addmonitor_one').val('None');
            $('#addmonitor_one_fk').val('0');
        } else {
            $('#addmonitor_one').val($selectedItem.children('.text').text());
            $('#addmonitor_one_fk').val(value);
        }
    }
});

$('.second_monitor_dropdown').dropdown({
    onChange: function(value, text, $selectedItem) {
        if (text === 'None') {
            $('#addmonitor_two').val('None');
            $('#addmonitor_two_fk').val('0');
        } else {
            $('#addmonitor_two').val($selectedItem.children('.text').text());
            $('#addmonitor_two_fk').val(value);
        }
    }
});

//PHONE

$('.phone_agent_dropdown').dropdown({
    onChange: function(value, text, $selectedItem) {
        var agentId = value;
        var agentName = $selectedItem.find('span.text').text();
        var formId = $(this).data('id');

        if (value !== "0") {
            $('#phone_agent_name_' + formId).val(agentName);
            $('#phone_agent_fk_id_' + formId).val(agentId);
        } else {
            $('#phone_agent_name_' + formId).val('None');
            $('#phone_agent_fk_id_' + formId).val(0);
        }
    }
});
function editPhoneStatus(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom status:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }

    var status = selectElement.value;
    var agentFkIdInput = $('.phone_agent_fk_id_');
    var agentInput = $('.phone_agent_name_');

    if (status !== 'Assigned' && status !== 'Unassigned') {
        agentFkIdInput.val(""); 
        agentInput.val(""); 
    }
}

$('.form-control#status').change(function() {
    editPhoneStatus(this);
});

$(document).ready(function() {
    $('#phone_equip_id').on('input', function() {
        var phone_equip_id = $(this).val();
        $.ajax({
            url: '<?= site_url('phone/check_equip_id') ?>',
            method: 'POST',
            data: { phone_equip_id: phone_equip_id },
            success: function(response) {
                if (response.exists) {
                    $('#phone_equip_id_error').text('Equipment ID already exists.');
                    $('#phonesaveBtn').prop('disabled', true);
                } else {
                    $('#phone_equip_id_error').text('');
                    $('#phonesaveBtn').prop('disabled', false);
                }
            }
        });
    });
});
$(document).ready(function(){
    $('.phone_agent_dropdown').change(function(){
        var agent_id = $(this).val();
        var row_id = $(this).data('id');
        $.ajax({
            url: '<?= site_url('phone_check_agentID/check') ?>',
            type: 'POST',
            data: {agent_id: agent_id},
            success: function(response){
                if(response.exists){
                    $('#phone_agent_id_error_'+row_id).html('Already assigned!');
                    $('#updatephone_'+row_id).prop('disabled', true);
                } else {
                    $('#phone_agent_id_error_'+row_id).html('');
                    $('#updatephone_'+row_id).prop('disabled', false);
                }
            }
        });
    });
});


//EDITSIMCARD

$('.edit_simcard_agentdropdown').dropdown({
    onChange: function(value, text, $selectedItem) {
        var id = $(this).data('id');
        var prefix = '#edit_';
        var agentInput = $(prefix + 'agent_' + id);

        if (value === 'Others') {
            // If "Others" is selected, show the input field and prompt for custom agent name
            agentInput.prop('readonly', false).show();
            var customAgentName = prompt('Enter custom agent name:');
            if (customAgentName !== null) {
                agentInput.val(customAgentName);
                $(prefix + 'agent_fk_id_' + id).val(''); // Reset value for custom entry
            } else {
                agentInput.val(''); // Clear input if user cancels the prompt
                $(this).dropdown('restore defaults');
            }
        } else {
            // For other options, hide the input field but set the selected agent name
            agentInput.val($selectedItem.children('.text').text());
            agentInput.prop('readonly', true).hide();
            $(prefix + 'agent_fk_id_' + id).val(value);
        }
    }
});



$('.edit_sgsimcard_dropdown').dropdown({
    onChange: function(value, text, $selectedItem) {
        var id = $(this).data('id');
        var prefix = '#edit_';
        if (text === 'Personal Phone') {
            $(prefix + 'phone_serial_no_' + id).val('Personal Phone');
            $(prefix + 'phone_fk_id_' + id).val('0');
            $(prefix + 'agent_fk_id_' + id).val('0');
            $(prefix + 'agent_' + id).val('None');
        } else if (text === 'None') {
            $(prefix + 'phone_serial_no_' + id).val('None');
            $(prefix + 'phone_fk_id_' + id).val('0');
            $(prefix + 'agent_fk_id_' + id).val('0');
            $(prefix + 'agent_' + id).val('None');
        } else {
            $(prefix + 'phone_serial_no_' + id).val($selectedItem.children('.text').text());
            $(prefix + 'phone_fk_id_' + id).val(value);
            // $(prefix + 'agent_fk_id_' + id).val($selectedItem.children('.hidden:eq(1)').text());
            // $(prefix + 'agent_' + id).val($selectedItem.children('.hidden:eq(0)').text());
        }
    }
});


// document.addEventListener('DOMContentLoaded', function () {
//     const sgsimcardDropdowns = document.querySelectorAll('.ui.search.selection.dropdown.edit_sgsimcard_dropdown');

//     function hideDropdown(dropdown, label) {
//         dropdown.style.display = 'none'; // Hide the dropdown
//         dropdown.querySelector('input[type="hidden"]').disabled = true;
//         label.style.display = 'none'; // Hide the label
//     }

//     function showDropdown(dropdown, label) {
//         dropdown.style.display = 'block'; // Show the dropdown
//         dropdown.querySelector('input[type="hidden"]').disabled = false;
//         label.style.display = 'block'; // Show the label
//     }

//     function handleDropdownChange() {
//         const selectedValue = this.querySelector('.text').textContent.trim();
//         const relatedDropdown = document.querySelector(`.edit_simcard_agentdropdown[data-id="${this.dataset.id}"]`);
//         const relatedLabel = document.querySelector(`label[for="edit_simcard_agentdropdown_${this.dataset.id}"]`);
//         if (selectedValue === 'Personal Phone') {
//             showDropdown(relatedDropdown, relatedLabel);
//         } else {
//             hideDropdown(relatedDropdown, relatedLabel);
//         }
//     }

//     sgsimcardDropdowns.forEach(function (dropdown) {
//         dropdown.addEventListener('change', handleDropdownChange);
//         const initialSelectedValue = dropdown.querySelector('.default.text').textContent.trim();
//         const relatedDropdown = document.querySelector(`.edit_simcard_agentdropdown[data-id="${dropdown.dataset.id}"]`);
//         const relatedLabel = document.querySelector(`label[for="edit_simcard_agentdropdown_${dropdown.dataset.id}"]`);
//         if (initialSelectedValue === 'Personal Phone') {
//             showDropdown(relatedDropdown, relatedLabel);
//         } else {
//             hideDropdown(relatedDropdown, relatedLabel);
//         }
//     });
// });

//AddSimcard



$('.simcard_agentdropdown').dropdown({
        onChange: function(value, text, $selectedItem) {
            if (value === 'Others') {
                var customAgentName = prompt('Enter custom agent name:');
                $('#agent').val(customAgentName).show(); // Show the input element
                $('#agent_fk_id').val(''); // Clear the ID field since it's a custom name
            } else {
                $('#agent').val($selectedItem.find('.text').text()).hide(); // Hide the input element
                $('#agent_fk_id').val(value);
            }
        }
    });


$('.sgsimcard_dropdown').dropdown({
    onChange: function(value, text, $selectedItem) {
        if (text === 'Personal Phone') {
            $('#phone_serial_no').val('Personal Phone');
            $('#phone_fk_id').val('0');
            $('#agent_fk_id').val('0');
            $('#agent').val('None');
        } else {
            $('#phone_serial_no').val($selectedItem.children('.text').text());
            $('#phone_fk_id').val(value);
            // $('#agent_fk_id').val($selectedItem.children('.hidden:eq(1)').text());
            // $('#agent').val($selectedItem.children('.hidden:eq(0)').text());
        }
    }
});




// document.addEventListener('DOMContentLoaded', function () {
//         const sgsimcardDropdown = document.querySelector('.sgsimcard_dropdown');
//         const simcardAgentDropdown = document.querySelector('.simcard_agentdropdown');

//     function hideDropdown() {
//         const agentNameLabel = document.querySelector('label[for^="simcard_agentdropdown_"]');
//         const simcardAgentDropdown = document.querySelector('.simcard_agentdropdown[data-id]');
        
//         if (agentNameLabel) {
//             agentNameLabel.style.display = 'none'; // Hide the Agent Name label
//         }
        
//         if (simcardAgentDropdown) {
//             simcardAgentDropdown.style.display = 'none'; // Hide the Agent Name dropdown
//             simcardAgentDropdown.querySelector('input[type="hidden"]').disabled = true;
//         }
//     }

//     function showDropdown() {
//         const agentNameLabel = document.querySelector('label[for^="simcard_agentdropdown_"]');
//         const simcardAgentDropdown = document.querySelector('.simcard_agentdropdown[data-id]');
        
//         if (agentNameLabel) {
//             agentNameLabel.style.display = 'block'; // Show the Agent Name label
//         }
        
//         if (simcardAgentDropdown) {
//             simcardAgentDropdown.style.display = 'block'; // Show the Agent Name dropdown
//             simcardAgentDropdown.querySelector('input[type="hidden"]').disabled = false;
//         }
//     }

//     sgsimcardDropdown.addEventListener('change', function () {
//         const selectedValue = sgsimcardDropdown.querySelector('.text').textContent.trim();
//         if (selectedValue === 'Personal Phone') {
//             showDropdown();
//         } else {
//             hideDropdown();
//         }
//     });

//     const initialSelectedValue = sgsimcardDropdown.querySelector('.text').textContent.trim();
//     if (initialSelectedValue === 'Personal Phone') {
//         showDropdown();
//     } else {
//         hideDropdown();
//     }
// });









//SGSIMCARD

//LAPTOP

$('.laptop_agent_dropdown').dropdown({
    onChange: function(value, text, $selectedItem) {
        var agentId = value;
        var agentName = $selectedItem.find('span.text').text();
        var formId = $(this).data('id');

        if (value !== "0") {
            $('#laptop_agent_' + formId).val(agentName);
            $('#laptop_agent_fk_id_' + formId).val(agentId);
        } else {
            $('#laptop_agent_' + formId).val('None');
            $('#laptop_agent_fk_id_' + formId).val(0);
        }
    }
});
function laptopStatusEdit(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom status:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }

    var status = selectElement.value;
    var agentFkIdInput = $('.laptop_agent_fk_id_');
    var agentInput = $('.laptop_agent_');

    if (status !== 'Assigned' && status !== 'Unassigned') {
        agentFkIdInput.val(""); 
        agentInput.val(""); 
    }
}

$('.form-control#status').change(function() {
    laptopStatusEdit(this);
});


$(document).ready(function() {
    $('#laptop_equip_id').on('input', function() {
        var laptop_equip_id = $(this).val();
        $.ajax({
            url: '<?= site_url('laptop_check_equip_id/check') ?>',
            method: 'POST',
            data: { laptop_equip_id: laptop_equip_id },
            success: function(response) {
                if (response.exists) {
                    $('#laptop_equip_id_error').text('Equipment ID already exists.');
                    $('#laptopsaveBtn').prop('disabled', true);
                } else {
                    $('#laptop_equip_id_error').text('');
                    $('#laptopsaveBtn').prop('disabled', false);
                }
            }
        });
    });
});
$(document).ready(function(){
    $('.laptop_agent_dropdown').change(function(){
        var agent_id = $(this).val();
        var row_id = $(this).data('id');
        $.ajax({
            url: '<?= site_url('laptop_check_agentID/check') ?>',
            type: 'POST',
            data: {agent_id: agent_id},
            success: function(response){
                if(response.exists){
                    $('#laptop_agent_id_error_'+row_id).html('Already assigned!');
                    $('#updateLaptop_'+row_id).prop('disabled', true);
                } else {
                    $('#laptop_agent_id_error_'+row_id).html('');
                    $('#updateLaptop_'+row_id).prop('disabled', false);
                }
            }
        });
    });
});

//WEBCAM

$('.webcam_agent_dropdown').dropdown({
    onChange: function(value, text, $selectedItem) {
        var agentId = value;
        var agentName = $selectedItem.find('span.text').text();
        var formId = $(this).data('id');

        if (value !== "0") {
            $('#webcam_agent_name_' + formId).val(agentName);
            $('#webcam_agent_fk_id_' + formId).val(agentId);
        } else {
            $('#webcam_agent_name_' + formId).val('None');
            $('#webcam_agent_fk_id_' + formId).val(0);
        }
    }
});
function webcamStatusEdit(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom status:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }

    var status = selectElement.value;
    var agentFkIdInput = $('.webcam_agent_fk_id_');
    var agentInput = $('.webcam_agent_name_');

    if (status !== 'Assigned' && status !== 'Unassigned') {
        agentFkIdInput.val(""); 
        agentInput.val(""); 
    }
}

$('.form-control#status').change(function() {
    webcamStatusEdit(this);
});
$(document).ready(function() {
    $('#webcam_equip_id').on('input', function() {
        var webcam_equip_id = $(this).val();
        $.ajax({
            url: '<?= site_url('webcam_check_equip_id/check') ?>',
            method: 'POST',
            data: { webcam_equip_id: webcam_equip_id },
            success: function(response) {
                if (response.exists) {
                    $('#webcam_equip_id_error').text('Equipment ID already exists.');
                    $('#webcam_saveBtn').prop('disabled', true);
                } else {
                    $('#webcam_equip_id_error').text('');
                    $('#webcam_saveBtn').prop('disabled', false);
                }
            }
        });
    });
});
$(document).ready(function(){
    $('.webcam_agent_dropdown').change(function(){
        var agent_id = $(this).val();
        var row_id = $(this).data('id');
        $.ajax({
            url: '<?= site_url('webcam_check_agentID/check') ?>',
            type: 'POST',
            data: {agent_id: agent_id},
            success: function(response){
                if(response.exists){
                    $('#webcam_agent_id_error_'+row_id).html('Already Assigned');
                    $('#updatewebcam_'+row_id).prop('disabled', true);
                } else {
                    $('#webcam_agent_id_error_'+row_id).html('');
                    $('#updatewebcam_'+row_id).prop('disabled', false);
                }
            }
        });
    });
});

//LOCKER

$(document).ready(function() {
    $('#locker_tool_id').on('input', function() {
        var locker_tool_id = $(this).val();
        $.ajax({
            url: '<?= site_url('locker_check_equip_id/check') ?>',
            method: 'POST',
            data: { locker_tool_id: locker_tool_id },
            success: function(response) {
                if (response.exists) {
                    $('#locker_tool_id_error').text('Equipment ID already exists.');
                    $('#locker_saveBtn').prop('disabled', true);
                } else {
                    $('#locker_tool_id_error').text('');
                    $('#locker_saveBtn').prop('disabled', false);
                }
            }
        });
    });
});

$(document).ready(function(){
    $('.locker_agent_dropdown').change(function(){
        var agent_id = $(this).val();
        var row_id = $(this).data('id');
        $.ajax({
            url: '<?= site_url('locker_check_agentID/check') ?>',
            type: 'POST',
            data: {agent_id: agent_id},
            success: function(response){
                if(response.exists){
                    $('#locker_agent_id_error_'+row_id).html('Already Assigned');
                    $('#updatelocker_'+row_id).prop('disabled', true);
                } else {
                    $('#locker_agent_id_error_'+row_id).html('');
                    $('#updatelocker_'+row_id).prop('disabled', false);
                }
            }
        });
    });
});

$('.cpu_agent_dropdown').dropdown({
    onChange: function(value, text, $selectedItem) {
        var agentId = value;
        var agentName = $selectedItem.find('span.text').text();
        var formId = $(this).data('id');

        if (value !== "0") {
            $('#cpu_agent_name_' + formId).val(agentName);
            $('#cpu_agent_fk_id_' + formId).val(agentId);
        } else {
            $('#cpu_agent_name_' + formId).val('None');
            $('#cpu_agent_fk_id_' + formId).val(0);
        }
    }
});

$('.locker_agent_dropdown').dropdown({
    onChange: function(value, text, $selectedItem) {
        var agentId = value;
        var agentName = $selectedItem.find('span.text').text();
        var formId = $(this).data('id');

        if (value !== "0") {
            $('#locker_agent_' + formId).val(agentName);
            $('#agent_fk_id_' + formId).val(agentId);
        } else {
            $('#locker_agent_' + formId).val('None');
            $('#agent_fk_id_' + formId).val(0);
        }
    }
});
function cpuEditStatus(selectElement) {
    var selectedValue = selectElement.value;
    if (selectedValue === "") {
        var newValue = prompt("Enter custom status:");
        if (newValue !== null) {
            var newOption = document.createElement("option");
            newOption.value = newValue;
            newOption.text = newValue;
            selectElement.add(newOption);
            selectElement.value = newValue;
        } 
    }

    var status = selectElement.value;
    var agentFkIdInput = $('.cpu_agent_fk_id_');
    var agentInput = $('.cpu_agent_name_');

    if (status !== 'Assigned' && status !== 'Unassigned') {
        agentFkIdInput.val(""); 
        agentInput.val(""); 
    }
}

$('.form-control#status').change(function() {
    cpuEditStatus(this);
});

$(document).ready(function () {
        $('.ui.dropdown').dropdown({
            onChange: function (value, text, $selectedItem) {
                if (value != 0) {
                    $.ajax({
                        url: '<?php echo base_url('get_agent_and_mouse_details'); ?>',
                        type: 'POST',
                        data: { id: value },
                        dataType: 'json',
                        success: function (response) {
                            $('#agent_id_input').val(response.agent_id);
                            $('#campaign_input').val(response.campaign);

                            $('.mouse_status_cell').text(response.mouse_status);
                            $('.mouse_equipment_id_cell').text(response.mouse_equip_id);
                            $('.mouse_brand_cell').text(response.mouse_brand);
                            $('.mouse_model_cell').text(response.mouse_model);
                            $('.mouse_condition_cell').text(response.mouse_condition);
                            $('.mouse_comment_cell').text(response.mouse_comment);

                            $('.keyboard_status_cell').text(response.keyboard_status);
                            $('.keyboard_equipment_id_cell').text(response.keyboard_equip_id);
                            $('.keyboard_brand_cell').text(response.keyboard_brand);
                            $('.keyboard_model_cell').text(response.keyboard_model);
                            $('.keyboard_condition_cell').text(response.keyboard_condition);
                            $('.keyboard_comment_cell').text(response.keyboard_comment);

                            $('.headset_status_cell').text(response.headset_status);
                            $('.headset_equipment_id_cell').text(response.headset_equip_id);
                            $('.headset_brand_cell').text(response.headset_brand);
                            $('.headset_model_cell').text(response.headset_model);
                            $('.headset_condition_cell').text(response.headset_condition);
                            $('.headset_comment_cell').text(response.headset_comment);

                            $('.cpu_status_cell').text(response.cpu_status);
                            $('.cpu_equipment_id_cell').text(response.cpu_equip_id);
                            $('.cpu_brand_cell').text(response.cpu_brand);
                            $('.cpu_model_cell').text(response.cpu_model);
                            $('.cpu_ram_size_cell').text(response.cpu_ram_size);
                            $('.cpu_processor_cell').text(response.cpu_processor);
                            $('.cpu_storage_type_cell').text(response.cpu_storage_type);
                            $('.cpu_conditions_cell').text(response.cpu_conditions);
                            $('.cpu_comment_cell').text(response.cpu_comment);

                            $('.locker_status_cell').text(response.locker_status);
                            $('.locker_locker_tool_id_cell').text(response.locker_tool_id);
                            $('.locker_condition_cell').text(response.locker_condition);
                            $('.locker_comment_cell').text(response.locker_comment);

                            $('.laptop_status_cell').text(response.laptop_status);
                            $('.laptop_laptop_equip_id_cell').text(response.laptop_equip_id);
                            $('.laptop_brand_cell').text(response.laptop_brand);
                            $('.laptop_model_cell').text(response.laptop_model);
                            $('.laptop_ram_cell').text(response.laptop_ram);
                            $('.laptop_processor_cell').text(response.laptop_processor);
                            $('.laptop_storage_cell').text(response.laptop_storage);
                            $('.laptop_condition_cell').text(response.laptop_condition);
                            $('.laptop_comment_cell').text(response.laptop_comment);
                            
                            $('.webcam_status_cell').text(response.webcam_status);
                            $('.webcam_equip_id_cell').text(response.webcam_equip_id);
                            $('.webcam_brand_cell').text(response.webcam_brand);
                            $('.webcam_model_cell').text(response.webcam_model);
                            $('.webcam_condition_cell').text(response.webcam_condition);
                            $('.webcam_comment_cell').text(response.webcam_comment);


                            $('.monitor_one_status_cell').text(response.monitor_one_status);
                            $('.monitor_one_equip_id_cell').text(response.monitor_one_equip_id);
                            $('.monitor_one_brand_cell').text(response.monitor_one_brand);
                            $('.monitor_one_model_cell').text(response.monitor_one_model);
                            $('.monitor_one_condition_cell').text(response.monitor_one_condition);
                            $('.monitor_one_comment_cell').text(response.monitor_one_comment);

                            $('.monitor_two_status_cell').text(response.monitor_two_status);
                            $('.monitor_two_equip_id_cell').text(response.monitor_two_equip_id);
                            $('.monitor_two_brand_cell').text(response.monitor_two_brand);
                            $('.monitor_two_model_cell').text(response.monitor_two_model);
                            $('.monitor_two_condition_cell').text(response.monitor_two_condition);
                            $('.monitor_two_comment_cell').text(response.monitor_two_comment);

                            $('.phone_status_cell').text(response.phone_status);
                            $('.phone_equip_id_cell').text(response.phone_equip_id);
                            $('.phone_brand_cell').text(response.phone_brand);
                            $('.phone_model_cell').text(response.phone_model);
                            $('.phone_condition_cell').text(response.phone_condition);
                            $('.phone_comment_cell').text(response.phone_comment);
                        },
                        error: function () {
                            console.error('Error fetching agent details');
                        }
                    });
                } else {
                    // Reset fields if None is selected
                    $('#agent_id_input').val('None');
                    $('#campaign_input').val('None');

                    $('.mouse_status_cell').text('None');
                    $('.mouse_equipment_id_cell').text('None');
                    $('.mouse_brand_cell').text('None');
                    $('.mouse_model_cell').text('None');
                    $('.mouse_condition_cell').text('None');
                    $('.mouse_comment_cell').text('None');

                    $('.keyboard_status_cell').text('None');
                    $('.keyboard_equipment_id_cell').text('None');
                    $('.keyboard_brand_cell').text('None');
                    $('.keyboard_model_cell').text('None');
                    $('.keyboard_condition_cell').text('None');
                    $('.keyboard_comment_cell').text('None');

                    
                    $('.headset_status_cell').text('None');
                    $('.headset_equipment_id_cell').text('None');
                    $('.headset_brand_cell').text('None');
                    $('.headset_model_cell').text('None');
                    $('.headset_condition_cell').text('None');
                    $('.headset_comment_cell').text('None');

                    $('.cpu_status_cell').text('None');
                    $('.cpu_equipment_id_cell').text('None');
                    $('.cpu_brand_cell').text('None');
                    $('.cpu_model_cell').text('None');
                    $('.cpu_ram_size_cell').text('None');
                    $('.cpu_processor_cell').text('None');
                    $('.cpu_storage_type_cell').text('None');
                    $('.cpu_conditions_cell').text('None');
                    $('.cpu_comment_cell').text('None');

                    $('.locker_status_cell').text('None');
                    $('.locker_locker_tool_id_cell').text('None');
                    $('.locker_condition_cell').text('None');
                    $('.locker_comment_cell').text('None');

                    $('.laptop_status_cell').text('None');
                    $('.laptop_laptop_equip_id_cell').text('None');
                    $('.laptop_brand_cell').text('None');
                    $('.laptop_model_cell').text('None');
                    $('.laptop_ram_cell').text('None');
                    $('.laptop_processor_cell').text('None');
                    $('.laptop_storage_cell').text('None');
                    $('.laptop_condition_cell').text('None');
                    $('.laptop_comment_cell').text('None');

                    $('.webcam_status_cell').text('None');
                    $('.webcam_equip_id_cell').text('None');
                    $('.webcam_brand_cell').text('None');
                    $('.webcam_model_cell').text('None');
                    $('.webcam_condition_cell').text('None');
                    $('.webcam_comment_cell').text('None');


                    $('.monitor_one_status_cell').text('None');
                    $('.monitor_one_equip_id_cell').text('None');
                    $('.monitor_one_brand_cell').text('None');
                    $('.monitor_one_model_cell').text('None');
                    $('.monitor_one_condition_cell').text('None');
                    $('.monitor_one_comment_cell').text('None');

                    $('.monitor_two_status_cell').text('None');
                    $('.monitor_two_equip_id_cell').text('None');
                    $('.monitor_two_brand_cell').text('None');
                    $('.monitor_two_model_cell').text('None');
                    $('.monitor_two_condition_cell').text('None');
                    $('.monitor_two_comment_cell').text('None');

                    $('.phone_status_cell').text('None');
                    $('.phone_equip_id_cell').text('None');
                    $('.phone_brand_cell').text('None');
                    $('.phone_model_cell').text('None');
                    $('.phone_condition_cell').text('None');
                    $('.phone_comment_cell').text('None');
                }
            }
        });
    });

$(document).ready(function() {
    $('#email_profile').on('input', function() {
        var email_profile = $(this).val();
        $.ajax({
            url: '<?= site_url('email_profile/check') ?>',
            method: 'POST',
            data: { email_profile: email_profile },
            success: function(response) {
                if (response.exists) {
                    $('#email_profile_error').text('Username Exists');
                    $('#email_profile_btn').prop('disabled', true);
                } else {
                    $('#email_profile_error').text('');
                    $('#email_profile_btn').prop('disabled', false);
                }
            }
        });
    });
});

$(document).ready(function() {
    $('#username_profile').on('input', function() {
        var username_profile = $(this).val();
        $.ajax({
            url: '<?= site_url('username_profile/check') ?>',
            method: 'POST',
            data: { username_profile: username_profile },
            success: function(response) {
                if (response.exists) {
                    $('#username_profile_error').text('Username Exists');
                    $('#username_profile_btn').prop('disabled', true);
                } else {
                    $('#username_profile_error').text('');
                    $('#username_profile_btn').prop('disabled', false);
                }
            }
        });
    });
});






















</script>