import { useEffect, useState } from "react";
import { useSelector } from "react-redux";
import {
    BgGlassFilterShape,
    MarketAnalysisShape,
    PageTopSection,
    RequestEvaluationCircleShape,
} from "../../components";
import { useSubmitRateRequestMutation } from "../../query";
import { SelectItem } from "../../types";
import Layout from "../layout/Layout";
import PropertyAddress from "./requestEvaluationForm/propertyAddress/PropertyAddress";
import PropertyDataForm from "./requestEvaluationForm/propertyDataForm/PropertyDataForm";
import PropertyDocuments from "./requestEvaluationForm/propertyDocuments/PropertyDocuments";
import RequestEvaluationFormButtonsBox from "./requestEvaluationForm/RequestEvaluationFormButtonsBox";
import RequestSubmittedSuccessfully from "./requestEvaluationForm/requestSubmittedSuccessfully/RequestSubmittedSuccessfully";
import UserInfoForm from "./requestEvaluationForm/userInfoForm/UserInfoForm";
import RequestEvaluationSteps from "./requestEvaluationSteps/RequestEvaluationSteps";
import TextBox from "./TextBox";

const RequestEvaluation = ({
    post_endpoint,
    goals,
    types,
    entities,
    usage,
}: {
    post_endpoint: string;
    goals: Array<SelectItem>;
    types: Array<SelectItem>;
    entities: Array<SelectItem>;
    usage: Array<SelectItem>;
}) => {
    const [step, setStep] = useState(1);

    const formDataObject = useSelector((state) => state.rateRequestForm);
    const formData = new FormData();
    Object.entries(formDataObject).forEach(([key, value]) => {
        if (Array.isArray(value)) {
            value.forEach((file) => {
                formData.append(`${key}[]`, file);
            });
        } else {
            formData.append(key, value);
        }
    });

    const [submitRateRequest] = useSubmitRateRequestMutation();

    // handle steps
    const handleNextStep = async () => {
        if (step === 4) {
            const { error } = await submitRateRequest({
                body: formData,
                url: post_endpoint,
            });
            if (error) {
                // Show error page
            } else {
                // Show success page
                setStep(step + 1);
            }
        }
        setStep(step + 1);
    };

    // handle steps
    const handlePrevStep = () => {
        setStep(step - 1);
    };

    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <>
            <PageTopSection title={"طلب تقييم"} description={"تقييم شامل"} />

            <section className="container md:mt-[211px] mt-[6rem] md:mb-0 mb-[50px] relative">
                <TextBox step={step} />
                <MarketAnalysisShape
                    position={
                        "2xl:left-80 xl:left-48 lg:left-20 -translate-x-1/2  md:top-0 top-64 z-[1]"
                    }
                />
                <BgGlassFilterShape
                    position={"md:hidden flex -right-48 top-48 z-[-1]"}
                />
                <div className="xl:w-[1200px] lg:w-[1024px] w-[360px] md:h-[862px] h-auto flex md:flex-row flex-col md:items-start items-center md:gap-[35px] gap-8  glass-effect glass-effect-bg-primary-3 rounded-tl-[100px] rounded-br-[100px] md:p-[50px]  py-8 px-6">
                    <RequestEvaluationSteps step={step} />

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
                                onHandleNextStep={handleNextStep}
                                onHandlePrevStep={handlePrevStep}
                            />
                        )}
                    </form>
                </div>
                <RequestEvaluationCircleShape
                    position={"md:flex hidden left-[-49px] top-1/2 z-[-1]"}
                />
            </section>
        </>
    );
};

RequestEvaluation.layout = (page: React.ReactNode) => (
    <Layout children={page} />
);

export default RequestEvaluation;
