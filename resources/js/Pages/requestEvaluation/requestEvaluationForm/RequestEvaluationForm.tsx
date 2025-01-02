import { SelectItem } from "../../../types";
import RequestEvaluationFormButtonsBox from "./RequestEvaluationFormButtonsBox";
import PropertyAddress from "./propertyAddress/PropertyAddress";
import PropertyDataForm from "./propertyDataForm/PropertyDataForm";
import PropertyDocuments from "./propertyDocuments/PropertyDocuments";
import RequestSubmittedSuccessfully from "./requestSubmittedSuccessfully/RequestSubmittedSuccessfully";
import UserInfoForm from "./userInfoForm/UserInfoForm";

export default function RequestEvaluationForm({
    step,
    onHandleNextStep,
    onHandlePrevStep,
    goals,
    types,
    entities,
    usage,
}: {
    step: number;
    onHandleNextStep: () => void;
    onHandlePrevStep: () => void;
    goals: Array<SelectItem>;
    types: Array<SelectItem>;
    entities: Array<SelectItem>;
    usage: Array<SelectItem>;
}) {
    return (
        <form className="md:w-[590px] w-full flex flex-col items-start gap-8">
            {step === 1 && <UserInfoForm goals={goals} />}
            {step === 2 && (
                <PropertyDataForm
                    types={types}
                    entities={entities}
                    usage={usage}
                />
            )}
            {step === 3 && <PropertyAddress />}
            {step === 4 && <PropertyDocuments />}
            {step === 5 && <RequestSubmittedSuccessfully />}

            {step !== 5 && (
                <RequestEvaluationFormButtonsBox
                    step={step}
                    onHandleNextStep={onHandleNextStep}
                    onHandlePrevStep={onHandlePrevStep}
                />
            )}
        </form>
    );
}
