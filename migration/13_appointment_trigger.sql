CREATE TRIGGER appointment_overlap
    BEFORE INSERT ON appointment
    FOR EACH ROW
BEGIN
    DECLARE overlap_count INT;
    DECLARE new_end DATETIME;

    SELECT DATE_ADD(NEW.appointment_start, INTERVAL t_duration MINUTE)
    INTO new_end
    FROM treatment
    WHERE tid = NEW.treatment;

    SELECT COUNT(*) INTO overlap_count
    FROM appointment a
    WHERE a.dentist = NEW.dentist
      AND lower(a.appointment_status) != 'cancelled'
      AND (
        (NEW.appointment_start >= a.appointment_start AND NEW.appointment_start < a.appointment_end)
            OR
        (new_end > a.appointment_start AND new_end <= a.appointment_end)
            OR
        (NEW.appointment_start <= a.appointment_start AND new_end >= a.appointment_end)
        );

    IF overlap_count > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'That time slot is already taken for the selected dentist.';
    END IF;
END