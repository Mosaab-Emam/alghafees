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
import FormBox from "./FormBox";
import TextBox from "./TextBox";

export default function RequestEvaluation({
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
}) {
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
        <Layout>
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
                <FormBox
                    onHandleNextStep={handleNextStep}
                    onHandlePrevStep={handlePrevStep}
                    step={step}
                    goals={goals}
                    types={types}
                    entities={entities}
                    usage={usage}
                />
                <RequestEvaluationCircleShape
                    position={"md:flex hidden left-[-49px] top-1/2 z-[-1]"}
                />
            </section>
        </Layout>
    );
}
