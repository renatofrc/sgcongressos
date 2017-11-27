CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_register_activity`(
pparticipant_id INT(11), 
pactivity_id INT(11), 
pevent_id INT(11)
)
BEGIN
     
 	INSERT INTO tb_participants_activities (participant_id, activity_id, event_id) 
 	VALUES (pparticipant_id, pactivity_id, pevent_id);
	
     IF (EXISTS(SELECT * FROM tb_participants_activities WHERE participant_id = pparticipant_id)) 
     THEN 
    
		UPDATE tb_activities SET subscribes = subscribes + 1 WHERE idactivity = pactivity_id;
	    
	END IF;

   
END