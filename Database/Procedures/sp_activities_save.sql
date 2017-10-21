CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_activities_save`(
pactivity_name VARCHAR(64), 
pdescription VARCHAR(255), 
pactivity_type VARCHAR(64),
pdata_activity VARCHAR(20),
pinitial_hour VARCHAR(20),   
pend_hour VARCHAR(20),
pvacancies INT(11),
pevent_id INT(11)
)
BEGIN
     
 	INSERT INTO tb_activities (activity_name, description, activity_type,
		 data_activity, initial_hour, end_hour, vacancies, event_id) 
    	VALUES(pactivity_name, pdescription, pactivity_type, pdata_activity, pinitial_hour, pend_hour, 
    	pvacancies, pevent_id);
	
     IF (EXISTS(SELECT * FROM tb_activities WHERE event_id = pevent_id)) THEN 
    
		UPDATE tb_event SET activities = activities + 1 WHERE idevent = pevent_id;
	    
	END IF;

   
END