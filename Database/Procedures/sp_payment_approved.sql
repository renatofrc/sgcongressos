CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_payment_approved`(
pidparticipant INT(11)
)

BEGIN 

	UPDATE tb_payment SET status = 'approved' WHERE create_user_id = pidparticipant;

	UPDATE tb_participants SET status = 1 WHERE idparticipant = pidparticipant;

END