
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_participants_save`(
ppname VARCHAR(150), 
pcpf VARCHAR(20), 
pphone BIGINT,
pemail VARCHAR(40),
plogin VARCHAR(64),   
ppassword VARCHAR(256),
pevent_id INT(11),
pcategory VARCHAR(50),
pidevent INT(11)
)

BEGIN
 
    DECLARE vidparticipant INT;
    
 	INSERT INTO tb_participants (pname, cpf, phone,
		 email, login, password, event_id, category) 
    VALUES(ppname, pcpf, pphone, pemail, plogin, ppassword, pevent_id, pcategory);
    
    SET vidparticipant = LAST_INSERT_ID();
    
    INSERT INTO tb_participants_events (idparticipant, idevent)
    VALUES(vidparticipant, pidevent);
    
    SELECT * FROM tb_participants a INNER JOIN tb_participants_events b USING(idparticipant) WHERE a.idparticipant = LAST_INSERT_ID();
    
END
