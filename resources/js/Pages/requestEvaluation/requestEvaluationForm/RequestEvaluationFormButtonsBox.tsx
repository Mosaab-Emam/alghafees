import React from "react";
import Button from "../../../components/button/Button";

const RequestEvaluationFormButtonsBox = ({
    step,
    onHandleNextStep,
    onHandlePrevStep,
}: {
    step: number;
    onHandleNextStep: () => void;
    onHandlePrevStep: () => void;
}) => {
    return (
        <div className="flex items-center gap-4 mr-auto ">
            <Button
                onClick={onHandlePrevStep}
                className={"w-[150px]"}
                variant="out-line"
                disabled={step === 1}
            >
                السابق
            </Button>
            <Button
                disabled={step === 5}
                onClick={onHandleNextStep}
                className={"w-[150px]"}
                radius={"right"}
            >
                {step === 4 ? "تقديم" : "التالي"}
            </Button>
        </div>
    );
};

export default RequestEvaluationFormButtonsBox;
