$(document).ready(function() {
    $('.accountability_agent_dropdown').change(function() {
        var agentId = $(this).val();
        if (agentId !== '0') {
            $.ajax({
                type: 'POST',
                url: 'get_agent_and_mouse_details', 
                data: { agent_id: agentId },
                dataType: 'json',
                success: function(response) {
                    if (response.agent_data) {
                        $('.agent_id_input').val(response.agent_data.agent_id);
                        $('.campaign_input').val(response.agent_data.campaign);
                    } else {
                        $('.agent_id_input').val('None');
                        $('.campaign_input').val('None');
                    }

                    if (response.mouse_data) {
                        $('.mouse_status_cell').text(response.mouse_data.status);
                        $('.mouse_equipment_id_cell').text(response.mouse_data.equip_id);
                        $('.mouse_brand_cell').text(response.mouse_data.brand);
                        $('.mouse_model_cell').text(response.mouse_data.model);
                        $('.mouse_condition_cell').text(response.mouse_data.mouse_condition);
                        $('.mouse_comment_cell').text(response.mouse_data.comment);
                    } else {
                        $('.mouse_status_cell').text('None');
                        $('.mouse_equipment_id_cell').text('None');
                        $('.mouse_brand_cell').text('None');
                        $('.mouse_model_cell').text('None');
                        $('.mouse_condition_cell').text('None');
                        $('.mouse_comment_cell').text('None');
                    }

                    if (response.keyboard_data) {
                        $('.keyboard_status_cell').text(response.keyboard_data.keyboard_status);
                        $('.keyboard_equipment_id_cell').text(response.keyboard_data.keyboard_equip_id);
                        $('.keyboard_brand_cell').text(response.keyboard_data.keyboard_brand);
                        $('.keyboard_model_cell').text(response.keyboard_data.keyboard_model);
                        $('.keyboard_condition_cell').text(response.keyboard_data.keyboard_condition);
                        $('.keyboard_comment_cell').text(response.keyboard_data.keyboard_comment);
                    } else {
                        $('.keyboard_status_cell').text('None');
                        $('.keyboard_equipment_id_cell').text('None');
                        $('.keyboard_brand_cell').text('None');
                        $('.keyboard_model_cell').text('None');
                        $('.keyboard_condition_cell').text('None');
                        $('.keyboard_comment_cell').text('None');
                    }

                    if (response.headset_data) {
                        $('.headset_status_cell').text(response.headset_data.status);
                        $('.headset_equipment_id_cell').text(response.headset_data.equip_id);
                        $('.headset_brand_cell').text(response.headset_data.brand);
                        $('.headset_model_cell').text(response.headset_data.model);
                        $('.headset_condition_cell').text(response.headset_data.condition);
                        $('.headset_comment_cell').text(response.headset_data.comment);
                    } else {
                        $('.headset_status_cell').text('None');
                        $('.headset_equipment_id_cell').text('None');
                        $('.headset_brand_cell').text('None');
                        $('.headset_model_cell').text('None');
                        $('.headset_condition_cell').text('None');
                        $('.headset_comment_cell').text('None');
                    }

                    if (response.cpu_data) {
                        $('.cpu_status_cell').text(response.cpu_data.status);
                        $('.cpu_equipment_id_cell').text(response.cpu_data.equip_id);
                        $('.cpu_brand_cell').text(response.cpu_data.brand);
                        $('.cpu_model_cell').text(response.cpu_data.model);
                        $('.cpu_ram_size_cell').text(response.cpu_data.ram_size);
                        $('.cpu_processor_cell').text(response.cpu_data.processor);
                        $('.cpu_storage_type_cell').text(response.cpu_data.storage_type);
                        $('.cpu_conditions_cell').text(response.cpu_data.conditions);
                        $('.cpu_comment_cell').text(response.cpu_data.comment);
                    } else {
                        $('.cpu_status_cell').text('None');
                        $('.cpu_equipment_id_cell').text('None');
                        $('.cpu_brand_cell').text('None');
                        $('.cpu_model_cell').text('None');
                        $('.cpu_ram_size_cell').text('None');
                        $('.cpu_processor_cell').text('None');
                        $('.cpu_storage_type_cell').text('None');
                        $('.cpu_conditions_cell').text('None');
                        $('.cpu_comment_cell').text('None');
                    }

                    if (response.locker_data) {
                        $('.locker_status_cell').text(response.locker_data.locker_status);
                        $('.locker_locker_tool_id_cell').text(response.locker_data.locker_tool_id);
                        $('.locker_condition_cell').text(response.locker_data.locker_condition);
                        $('.locker_comment_cell').text(response.locker_data.locker_comment);
                    } else {
                        $('.locker_status_cell').text('None');
                        $('.locker_locker_tool_id_cell').text('None');
                        $('.locker_condition_cell').text('None');
                        $('.locker_comment_cell').text('None');
                    }

                    if (response.laptop_data) {
                        $('.laptop_status_cell').text(response.laptop_data.laptop_status);
                        $('.laptop_laptop_equip_id_cell').text(response.laptop_data.laptop_equip_id);
                        $('.laptop_brand_cell').text(response.laptop_data.laptop_brand);
                        $('.laptop_model_cell').text(response.laptop_data.laptop_model);
                        $('.laptop_ram_cell').text(response.laptop_data.laptop_ram);
                        $('.laptop_processor_cell').text(response.laptop_data.laptop_processor);
                        $('.laptop_storage_cell').text(response.laptop_data.laptop_storage);
                        $('.laptop_condition_cell').text(response.laptop_data.laptop_condition);
                        $('.laptop_comment_cell').text(response.laptop_data.laptop_comment);
                    } else {
                        $('.laptop_status_cell').text('None');
                        $('.laptop_laptop_equip_id_cell').text('None');
                        $('.laptop_brand_cell').text('None');
                        $('.laptop_model_cell').text('None');
                        $('.laptop_ram_cell').text('None');
                        $('.laptop_processor_cell').text('None');
                        $('.laptop_storage_cell').text('None');
                        $('.laptop_condition_cell').text('None');
                        $('.laptop_comment_cell').text('None');
                    }

                    if (response.webcam_data) {
                        $('.webcam_status_cell').text(response.webcam_data.webcam_status);
                        $('.webcam_equip_id_cell').text(response.webcam_data.webcam_equip_id);
                        $('.webcam_brand_cell').text(response.webcam_data.webcam_brand);
                        $('.webcam_model_cell').text(response.webcam_data.webcam_model);
                        $('.webcam_condition_cell').text(response.webcam_data.webcam_condition);
                        $('.webcam_comment_cell').text(response.webcam_data.webcam_comment);
                    } else {
                        $('.webcam_status_cell').text('None');
                        $('.webcam_equip_id_cell').text('None');
                        $('.webcam_brand_cell').text('None');
                        $('.webcam_model_cell').text('None');
                        $('.webcam_condition_cell').text('None');
                        $('.webcam_comment_cell').text('None');
                    }

                    if (response.phone_data) {
                        $('.phone_status_cell').text(response.phone_data.phone_status);
                        $('.phone_equip_id_cell').text(response.phone_data.phone_equip_id);
                        $('.phone_brand_cell').text(response.phone_data.phone_brand);
                        $('.phone_model_cell').text(response.phone_data.phone_model);
                        $('.phone_condition_cell').text(response.phone_data.phone_condition);
                        $('.phone_comment_cell').text(response.phone_data.phone_comment);
                    } else {
                        $('.phone_status_cell').text('None');
                        $('.phone_equip_id_cell').text('None');
                        $('.phone_brand_cell').text('None');
                        $('.phone_model_cell').text('None');
                        $('.phone_condition_cell').text('None');
                        $('.phone_comment_cell').text('None');
                    }

                    if (response.monitor_data && response.monitor_data.length > 0) {
                        $('.monitor_one_status_cell').text(response.monitor_data[0].monitor_status);
                        $('.monitor_one_equip_id_cell').text(response.monitor_data[0].monitor_equip_id);
                        $('.monitor_one_brand_cell').text(response.monitor_data[0].monitor_brand);
                        $('.monitor_one_model_cell').text(response.monitor_data[0].monitor_model);
                        $('.monitor_one_condition_cell').text(response.monitor_data[0].monitor_condition);
                        $('.monitor_one_comment_cell').text(response.monitor_data[0].monitor_comment);
                    } else {
                        $('.monitor_one_status_cell').text('None');
                        $('.monitor_one_equip_id_cell').text('None');
                        $('.monitor_one_brand_cell').text('None');
                        $('.monitor_one_model_cell').text('None');
                        $('.monitor_one_condition_cell').text('None');
                        $('.monitor_one_comment_cell').text('None');
                    }

                    // Display second monitor data
                    if (response.monitor_data && response.monitor_data.length > 1) {
                        $('.monitor_two_status_cell').text(response.monitor_data[1].monitor_status);
                        $('.monitor_two_equip_id_cell').text(response.monitor_data[1].monitor_equip_id);
                        $('.monitor_two_brand_cell').text(response.monitor_data[1].monitor_brand);
                        $('.monitor_two_model_cell').text(response.monitor_data[1].monitor_model);
                        $('.monitor_two_condition_cell').text(response.monitor_data[1].monitor_condition);
                        $('.monitor_two_comment_cell').text(response.monitor_data[1].monitor_comment);
                    } else {
                        $('.monitor_two_status_cell').text('None');
                        $('.monitor_two_equip_id_cell').text('None');
                        $('.monitor_two_brand_cell').text('None');
                        $('.monitor_two_model_cell').text('None');
                        $('.monitor_two_condition_cell').text('None');
                        $('.monitor_two_comment_cell').text('None');
                    }

                    
                    
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        } else {
            $('.agent_id_input').val('');
            $('.campaign_input').val('');
            $('.mouse_status_cell').text('');
            $('.mouse_equipment_id_cell').text('');
            $('.mouse_brand_cell').text('');
            $('.mouse_model_cell').text('');
            $('.mouse_condition_cell').text('');
            $('.mouse_comment_cell').text('');

            $('.keyboard_status_cell').text('');
            $('.keyboard_equipment_id_cell').text('');
            $('.keyboard_brand_cell').text('');
            $('.keyboard_model_cell').text('');
            $('.keyboard_condition_cell').text('');
            $('.keyboard_comment_cell').text('');

            $('.headset_status_cell').text('');
            $('.headset_equipment_id_cell').text('');
            $('.headset_brand_cell').text('');
            $('.headset_model_cell').text('');
            $('.headset_condition_cell').text('');
            $('.headset_comment_cell').text('');

            $('.cpu_status_cell').text('');
            $('.cpu_equipment_id_cell').text('');
            $('.cpu_brand_cell').text('');
            $('.cpu_model_cell').text('');
            $('.cpu_ram_size_cell').text('');
            $('.cpu_processor_cell').text('');
            $('.cpu_storage_type_cell').text('');
            $('.cpu_conditions_cell').text('');
            $('.cpu_comment_cell').text('');

            $('.locker_status_cell').text('');
            $('.locker_locker_tool_id_cell').text('');
            $('.locker_condition_cell').text('');
            $('.locker_comment_cell').text('');

            $('.laptop_status_cell').text('');
            $('.laptop_laptop_equip_id_cell').text('');
            $('.laptop_brand_cell').text('');
            $('.laptop_model_cell').text('');
            $('.laptop_ram_cell').text('');
            $('.laptop_processor_cell').text('');
            $('.laptop_storage_cell').text('');
            $('.laptop_condition_cell').text('');
            $('.laptop_comment_cell').text('');

            $('.webcam_status_cell').text('');
            $('.webcam_equip_id_cell').text('');
            $('.webcam_brand_cell').text('');
            $('.webcam_model_cell').text('');
            $('.webcam_condition_cell').text('');
            $('.webcam_comment_cell').text('');

            $('.monitor_one_status_cell').text('');
            $('.monitor_one_equip_id_cell').text('');
            $('.monitor_one_brand_cell').text('');
            $('.monitor_one_model_cell').text('');
            $('.monitor_one_condition_cell').text('');
            $('.monitor_one_comment_cell').text('');

            $('.monitor_two_status_cell').text('');
            $('.monitor_two_equip_id_cell').text('');
            $('.monitor_two_brand_cell').text('');
            $('.monitor_two_model_cell').text('');
            $('.monitor_two_condition_cell').text('');
            $('.monitor_two_comment_cell').text('');

            $('.phone_status_cell').text('');
            $('.phone_equip_id_cell').text('');
            $('.phone_brand_cell').text('');
            $('.phone_model_cell').text('');
            $('.phone_condition_cell').text('');
            $('.phone_comment_cell').text('');
        }
    });
});