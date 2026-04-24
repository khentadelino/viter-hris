import React from "react";
import { StoreContext } from "../../../../store/StoreContext";
import * as Yup from "yup";
import { useMutation, useQueryClient } from "@tanstack/react-query";
import { queryData } from "../../../../functions/custom-hooks/queryData";
import { apiVersion } from "../../../../functions/functions-general";
import {
  setIsAdd,
  setSuccess,
  setError,
  setMessage,
} from "../../../../store/StoreAction";
import ModalWrapperSide from "../../../../partials/modals/ModalWrapperSide";
import { FaTimes } from "react-icons/fa";
import { Formik, Form } from "formik";
import ButtonSpinner from "../../../../partials/spinners/ButtonSpinner";
import {
  InputSelect,
  InputText,
} from "../../../../components/form-input/FormInputs";
import MessageError from "../../../../partials/MessageError";

const ModalAddNotification = ({ itemEdit }) => {
  const { store, dispatch } = React.useContext(StoreContext);

  const queryClient = useQueryClient();

  const mutation = useMutation({
    mutationFn: (values) =>
      queryData(
        itemEdit
          ? `${apiVersion}/controllers/developers/settings/notification/notification.php?id=${itemEdit.notification_aid}`
          : `${apiVersion}/controllers/developers/settings/notification/notification.php`,
        itemEdit ? "put" : "post",
        values,
      ),
    onSuccess: (data) => {
      queryClient.invalidateQueries({ queryKey: ["notification"] });

      if (data.success) {
        dispatch(setSuccess(true));
        dispatch(setMessage(`Successfully ${itemEdit ? "updated" : "added"}`));
        dispatch(setIsAdd(false));
      }
    },
    onError: (error) => {
      dispatch(setError(true));
      dispatch(setMessage(error.message || "Something went wrong."));
    },
  });

  const initVal = {
    ...itemEdit,
    notification_first_name: itemEdit?.notification_first_name || "",
    notification_last_name: itemEdit?.notification_last_name || "",
    notification_email: itemEdit?.notification_email || "",
    notification_purpose: itemEdit?.notification_purpose || "",
    notification_first_name_old: itemEdit?.notification_first_name || "",
    notification_last_name_old: itemEdit?.notification_last_name || "",
    notification_email_old: itemEdit?.notification_email || "",
  };

  const yupSchema = Yup.object({
    notification_first_name: Yup.string().trim().required("required"),
    notification_last_name: Yup.string().trim().required("required"),
    notification_email: Yup.string()
      .trim()
      .email("Invalid email")
      .required("required"),
    notification_purpose: Yup.string().trim().required("required"),
  });

  const handleClose = () => {
    dispatch(setIsAdd(false));
  };

  React.useEffect(() => {
    dispatch(setError(false));
  }, []);

  return (
    <ModalWrapperSide handleClose={handleClose}>
      {/* HEADER */}
      <div className="modal-header relative mb-4">
        <h3 className="text-dark text-sm">
          {itemEdit ? "Update" : "Add"} Notification
        </h3>
        <button
          type="button"
          className="absolute top-0 right-4"
          onClick={handleClose}
        >
          <FaTimes />
        </button>
      </div>

      {/* BODY */}
      <div className="modal-body">
        <Formik
          initialValues={initVal}
          validationSchema={yupSchema}
          onSubmit={async (values) => {
            dispatch(setError(false));
            await mutation.mutateAsync(values);
          }}
        >
          {(props) => (
            <Form className="h-full">
              <div className="modal-form-container">
                <div className="modal-container">
                  <div className="relative mb-6">
                    <InputText
                      label="First Name"
                      name="notification_first_name"
                      type="text"
                      disabled={mutation.isPending}
                    />
                  </div>

                  <div className="relative mb-6">
                    <InputText
                      label="Last Name"
                      name="notification_last_name"
                      type="text"
                      disabled={mutation.isPending}
                    />
                  </div>

                  <div className="relative mb-6">
                    <InputText
                      label="Email"
                      name="notification_email"
                      type="text"
                      disabled={mutation.isPending}
                    />
                  </div>

                  <div className="relative mb-6">
                    <InputSelect
                      label="Purpose"
                      name="notification_purpose"
                      disabled={mutation.isPending}
                    >
                      <option value="" hidden>
                        --
                      </option>
                      <option value="Leave">Leave</option>
                      <option value="Overtime">Overtime</option>
                    </InputSelect>
                    {store.error && <MessageError />}
                  </div>
                </div>

                <div className="modal-action">
                  <button
                    type="submit"
                    disabled={mutation.isPending || !props.dirty}
                    className="btn-modal-submit"
                  >
                    {mutation.isPending ? (
                      <ButtonSpinner />
                    ) : itemEdit ? (
                      "Save"
                    ) : (
                      "Add"
                    )}
                  </button>

                  <button
                    type="reset"
                    className="btn-modal-cancel"
                    onClick={handleClose}
                    disabled={mutation.isPending}
                  >
                    Cancel
                  </button>
                </div>
              </div>
            </Form>
          )}
        </Formik>
      </div>
    </ModalWrapperSide>
  );
};

export default ModalAddNotification;
