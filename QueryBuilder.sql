
SELECT
  U.id,
  U.name as 'Name',
  U.email as 'Personal Email',
  U.mad_email as 'MAD Email',
  GROUP_CONCAT(G.name) as 'Roles',
  Credit_Data.answer as 'Accurate Credits?',
  Credit.value as 'Actual Credit',
  Credit.data as 'Credit Mismatch Reason',
  Training.answer as 'Accurate Training Data?',
  Training_Reason.answer as 'Training Data Reason',
  SQ2.answer as 'Does your session participation seem right?', UD.data as 'Additional Consideration'
FROM User U
INNER JOIN UserGroup UG ON UG.user_id = U.id
INNER JOIN `Group` G ON G.id = UG.group_id
LEFT JOIN (
  SELECT UA.user_id as user_id, SA.answer
  FROM SS_UserAnswer UA
  INNER JOIN SS_Answer SA on SA.id = UA.answer
  INNER JOIN SS_Question SQ on SQ.id = SA.question_id
  INNER JOIN SS_Survey_Event SE on SE.id = SQ.survey_event_id
  WHERE SE.id = 8 AND SQ.id = 19
) Credit_Data ON Credit_Data.user_id = U.id
LEFT JOIN (
  SELECT UD.user_id as user_id, UD.data as data, UD.value as value, UD.name as name
  FROM UserData UD
  WHERE UD.name = "user_credit_update"
) Credit ON Credit.user_id = U.id
LEFT JOIN (
  SELECT UA.user_id as user_id, SA.answer
  FROM SS_UserAnswer UA
  INNER JOIN SS_Answer SA on SA.id = UA.answer
  INNER JOIN SS_Question SQ on SQ.id = SA.question_id
  INNER JOIN SS_Survey_Event SE on SE.id = SQ.survey_event_id
  WHERE SE.id = 8 AND SQ.id = 22
) Training_Reason ON Training_Reason.user_id = U.id
LEFT JOIN (
  SELECT UA.user_id as user_id, SA.answer
  FROM SS_UserAnswer UA
  INNER JOIN SS_Answer SA on SA.id = UA.answer
  INNER JOIN SS_Question SQ on SQ.id = SA.question_id
  INNER JOIN SS_Survey_Event SE on SE.id = SQ.survey_event_id
  WHERE SE.id = 8 AND SQ.id = 21
) Training ON Training.user_id = U.id
LEFT JOIN (
  SELECT UA.user_id as user_id, SA.answer
  FROM SS_UserAnswer UA
  INNER JOIN SS_Answer SA on SA.id = UA.answer
  INNER JOIN SS_Question SQ on SQ.id = SA.question_id
  INNER JOIN SS_Survey_Event SE on SE.id = SQ.survey_event_id
  WHERE SE.id = 8 AND SQ.id = 20
) SQ2 ON SQ2.user_id = U.id
LEFT JOIN (
  SELECT UD.user_id as user_id, UD.data as data, UD.value as value, UD.name as name
  FROM UserData UD
  WHERE UD.name = "participation_additional_consideration_2017"
) UD ON UD.user_id = U.id

WHERE U.user_type = "volunteer"
  AND U.status = 1
  AND UG.year = 2017
GROUP BY  U.id
ORDER BY U.id ASC
