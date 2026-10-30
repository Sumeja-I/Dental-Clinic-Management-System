CREATE FUNCTION calculate_appointment_total_price(p_treatment_id INT)
    RETURNS DECIMAL(8,2)
    DETERMINISTIC
BEGIN
    DECLARE v_price DECIMAL(8,2);

SELECT price INTO v_price
FROM treatment
WHERE tid = p_treatment_id;

RETURN v_price;
END
