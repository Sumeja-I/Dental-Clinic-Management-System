CREATE PROCEDURE book_appointment(
    IN p_patient_id   INT,
    IN p_treatment_id INT,
    IN p_start        DATETIME
)
BEGIN
    DECLARE v_dentist_id  INT;
    DECLARE v_end         DATETIME;
    DECLARE v_price       DECIMAL(8,2);

    -- Compute end time and grab price from treatment
    SELECT
        DATE_ADD(p_start, INTERVAL t_duration MINUTE),
        price
    INTO v_end, v_price
    FROM treatment
    WHERE tid = p_treatment_id;

    -- Find the dentist whose speciality matches the treatment's category
    -- treatment.category (FK) -> category.cid
    -- category.cid is matched against speciality.sid (same domain — speciality covers a category)
    -- dentist.specialty (FK) -> speciality.sid
    SELECT d.did
    INTO   v_dentist_id
    FROM   dentist d
               JOIN   speciality s ON s.sid = d.specialty
               JOIN   treatment  t ON t.category = s.sid
    WHERE  t.tid = p_treatment_id
    LIMIT 1;

    -- No dentist covers this treatment's category
    IF v_dentist_id IS NULL THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'No dentist found for the selected treatment.';
    END IF;

    IF p_start < NOW() THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Appointment date cannot be in the past.';
    END IF;

    -- Insert — the appointment_overlap trigger fires here automatically
    INSERT INTO appointment
    (appointment_start, appointment_end,
     people, dentist, treatment, app_total_price)
    VALUES
        ( p_start, v_end,
         p_patient_id, v_dentist_id, p_treatment_id, calculate_appointment_total_price(p_treatment_id));

END;