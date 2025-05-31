import Container from "@/components/Container";
import {
    stepFourSchema,
    stepOneSchema,
    stepThreeSchema,
    stepTwoSchema,
} from "@/schemas";
import { staticContext } from "@/utils/contexts";
import { useForm } from "@inertiajs/react";
import React, { useContext, useEffect, useState } from "react";
import {
    BgGlassFilterShape,
    MarketAnalysisShape,
    PageTopSection,
    RequestEvaluationCircleShape,
} from "../../components";
import { SelectItem } from "../../types";
import UploadFIleInput from "../joinUs/UploadFIleInput";
import Layout from "../layout/Layout";
import Input from "./Input";
import PricePackageSelector from "./PricePackageSelector";
import RequestEvaluationFormButtonsBox from "./requestEvaluationForm/RequestEvaluationFormButtonsBox";
import RequestEvaluationFormInput from "./requestEvaluationForm/RequestEvaluationFormInput";
import RequestEvaluationFormSelectInput from "./requestEvaluationForm/RequestEvaluationFormSelectInput";
import RequestEvaluationFormTextArea from "./requestEvaluationForm/RequestEvaluationFormTextArea";
import RequestSubmittedSuccessfully from "./requestEvaluationForm/requestSubmittedSuccessfully/RequestSubmittedSuccessfully";
import RequestEvaluationSteps from "./requestEvaluationSteps/RequestEvaluationSteps";
import TextBox from "./TextBox";

const RequestEvaluation = ({
    goals,
    types,
    entities,
    usage,
    request_no,
}: {
    goals: Array<SelectItem>;
    types: Array<SelectItem>;
    entities: Array<SelectItem>;
    usage: Array<SelectItem>;
    request_no: number | null;
}) => {
    const static_content = useContext<Record<string, string>>(staticContext);
    const [step, setStep] = useState(1);
    const [validationErrors, setValidationErrors] = useState<
        Record<string, string>
    >({});

    const { data, setData, post } = useForm({
        name: null, // Legacy
        first_name: "",
        last_name: "",
        mobile: "",
        email: "",
        address: "",
        goal_id: "",
        notes: "",
        type_id: "",
        real_estate_details: "",
        entity_id: "",
        real_estate_age: "",
        real_estate_area: "",
        usage_id: "",
        location: null, // Legacy
        estate_city: "",
        estate_region: "",
        estate_line_1: "",
        estate_line_2: "",
        instrument_image: null,
        construction_license: null,
        other_contracts: null,
        price_package_id: "",
    });

    const { data: stepThreeData, setData: setStepThreeData } = useForm({
        estate_city: "",
        estate_region: "",
        estate_line_1: "",
        estate_line_2: "",
    });

    const emitSelectedPricePackage = (price_package: number) => {
        setData("price_package_id", price_package.toString());
    };

    // handle steps
    const handlePrevStep = () => setStep(step - 1);

    const validateStep = () => {
        try {
            switch (step) {
                case 1:
                    stepOneSchema.parse(data);
                    break;
                case 2:
                    stepTwoSchema.parse(data);
                    break;
                case 3:
                    stepThreeSchema.parse(stepThreeData);
                    Object.entries(stepThreeData).forEach(([key, value]) => {
                        setData(key as keyof typeof stepThreeData, value);
                    });
                    break;
                case 4:
                    stepFourSchema.parse({
                        instrument_image: data.instrument_image,
                        construction_license: data.construction_license,
                        other_contracts: data.other_contracts,
                    });
                    break;
            }
            setValidationErrors({});
            return true;
        } catch (error: any) {
            if (error.errors) {
                const errors: Record<string, string> = {};
                error.errors.forEach((err: any) => {
                    if (err.path && err.path.length > 0) {
                        errors[err.path[0]] = err.message;
                    }
                });
                setValidationErrors(errors);
            }
            return false;
        }
    };

    const handleNextStep = () => {
        if (validateStep()) {
            if (step === 4) {
                post("/legacy/rate-request", {
                    forceFormData: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        setStep(step + 1);

                        // @ts-ignore
                        window.dataLayer = window.dataLayer || [];

                        function gtag() {
                            // @ts-ignore
                            window.dataLayer.push(arguments);
                        }

                        // @ts-ignore
                        gtag("event", "conversion", {
                            send_to: "AW-11048763710/sjDfCP2LldMZEL6Cu5Qp",
                        });
                    },
                });
            } else {
                setStep(step + 1);
            }
        }
    };

    return (
        <>
            <PageTopSection
                title={static_content["small_top_title"]}
                description={static_content["main_top_title"]}
            />
            <section className="md:mt-[211px] mt-[6rem] md:mb-0 mb-12 relative">
                <Container>
                    <div className="flex flex-col md:flex-row items-center justify-between mb-12">
                        <TextBox />
                        <MarketAnalysisShape />
                    </div>
                    <BgGlassFilterShape
                        position={"md:hidden flex -right-48 top-48 z-[-1]"}
                    />

                    <div className="mb-12">
                        <PricePackageSelector
                            emitSelectedPricePackage={emitSelectedPricePackage}
                        />
                    </div>

                    <div className="xl:w-[1200px] lg:w-[1024px] flex lg:flex-row flex-col md:items-start items-center lg:gap-[35px] gap-8 glass-effect glass-effect-bg-primary-3 rounded-tl-[100px] rounded-br-[100px] lg:p-[50px]  py-8 px-6">
                        <RequestEvaluationSteps step={step} />
                        <form className="w-full flex flex-col items-start gap-8">
                            <StepThree
                                step={step}
                                data={stepThreeData}
                                setData={setStepThreeData}
                                validationErrors={validationErrors}
                            />
                            {step === 1 && (
                                <section className="w-full h-full flex flex-col items-start gap-8">
                                    <div className="w-full md:flex-row flex-col flex items-center self-stretch gap-[20px]">
                                        <RequestEvaluationFormInput
                                            type="text"
                                            label="الاسم الاول"
                                            name="first_name"
                                            value={data.first_name}
                                            error={validationErrors?.first_name}
                                            placeholder="ادخل اسمك بالكامل هنا"
                                            required
                                            onChange={(
                                                e: React.ChangeEvent<HTMLInputElement>
                                            ) =>
                                                setData(
                                                    "first_name",
                                                    e.target.value
                                                )
                                            }
                                        />
                                        <RequestEvaluationFormInput
                                            type="text"
                                            label="الاسم الاخير"
                                            name="last_name"
                                            value={data.last_name}
                                            error={validationErrors?.last_name}
                                            placeholder="ادخل اسمك بالكامل هنا"
                                            required
                                            onChange={(
                                                e: React.ChangeEvent<HTMLInputElement>
                                            ) =>
                                                setData(
                                                    "last_name",
                                                    e.target.value
                                                )
                                            }
                                        />
                                    </div>

                                    <div className="w-full md:flex-row flex-col flex items-center self-stretch gap-[20px]">
                                        <RequestEvaluationFormInput
                                            type="tel"
                                            label="رقم الجوال"
                                            name="mobile"
                                            value={data.mobile}
                                            error={validationErrors?.mobile}
                                            required
                                            onChange={(
                                                e: React.ChangeEvent<HTMLInputElement>
                                            ) =>
                                                setData(
                                                    "mobile",
                                                    e.target.value
                                                )
                                            }
                                            placeholder="ادخل رقم جوالك يبدأ ب 05 هنا"
                                        />

                                        <RequestEvaluationFormInput
                                            type="email"
                                            label="البريد الالكتروني"
                                            name="email"
                                            value={data.email}
                                            error={validationErrors?.email}
                                            required
                                            onChange={(
                                                e: React.ChangeEvent<HTMLInputElement>
                                            ) =>
                                                setData("email", e.target.value)
                                            }
                                            placeholder="ادخل بريدك الالكتروني هنا"
                                        />
                                    </div>

                                    <RequestEvaluationFormInput
                                        type="text"
                                        label="عنوان طالب التقييم"
                                        name="address"
                                        value={data.address}
                                        error={validationErrors?.address}
                                        required
                                        onChange={(
                                            e: React.ChangeEvent<HTMLInputElement>
                                        ) => setData("address", e.target.value)}
                                        placeholder="ادخل عنوانك الحالي هنا"
                                    />

                                    <RequestEvaluationFormSelectInput
                                        name="goal_id"
                                        label="الغرض من التقييم"
                                        value={data.goal_id}
                                        error={validationErrors?.goal_id}
                                        required
                                        onChange={(
                                            e: React.ChangeEvent<HTMLSelectElement>
                                        ) => setData("goal_id", e.target.value)}
                                        placeholder="اختر الغرض من التقييم"
                                        data={goals}
                                    />

                                    <RequestEvaluationFormTextArea
                                        name="notes"
                                        label="تفاصيل الغرض من التقييم"
                                        value={data.notes}
                                        error={validationErrors?.notes}
                                        required
                                        onChange={(
                                            e: React.ChangeEvent<HTMLTextAreaElement>
                                        ) => setData("notes", e.target.value)}
                                        placeholder="ادخل تفاصيل الغرض من التقييم الذي تريده"
                                    />
                                </section>
                            )}
                            {step === 2 && (
                                <section className="w-full h-full flex flex-col items-start gap-8">
                                    <RequestEvaluationFormSelectInput
                                        name="type_id"
                                        label="نوع العقار محل التقييم"
                                        placeholder="اختر نوع العقار "
                                        data={types}
                                        value={data.type_id}
                                        error={validationErrors?.type_id}
                                        required
                                        onChange={(
                                            e: React.ChangeEvent<HTMLSelectElement>
                                        ) => setData("type_id", e.target.value)}
                                    />

                                    <RequestEvaluationFormTextArea
                                        name="real_estate_details"
                                        label="تفاصيل العقار"
                                        value={data.real_estate_details}
                                        error={
                                            validationErrors?.real_estate_details
                                        }
                                        onChange={(
                                            e: React.ChangeEvent<HTMLTextAreaElement>
                                        ) =>
                                            setData(
                                                "real_estate_details",
                                                e.target.value
                                            )
                                        }
                                        placeholder="ادخل تفاصيل العقار هنا"
                                    />

                                    <RequestEvaluationFormSelectInput
                                        name={"entity_id"}
                                        label="الجهه الموجه اليها التقييم"
                                        placeholder="اختر الجهه"
                                        data={entities}
                                        value={data.entity_id}
                                        error={validationErrors?.entity_id}
                                        onChange={(
                                            e: React.ChangeEvent<HTMLSelectElement>
                                        ) =>
                                            setData("entity_id", e.target.value)
                                        }
                                    />

                                    <div className="w-full flex md:flex-row flex-col  items-center self-stretch gap-[20px] ">
                                        <RequestEvaluationFormInput
                                            type="number"
                                            label="العمر"
                                            name="real_estate_age"
                                            placeholder="ادخل العمر بعدد السنوات هنا"
                                            value={data.real_estate_age}
                                            error={
                                                validationErrors?.real_estate_age
                                            }
                                            required
                                            onChange={(
                                                e: React.ChangeEvent<HTMLInputElement>
                                            ) =>
                                                setData(
                                                    "real_estate_age",
                                                    e.target.value
                                                )
                                            }
                                        />
                                        <RequestEvaluationFormInput
                                            type="number"
                                            name="real_estate_area"
                                            label="المساحة"
                                            placeholder="ادخل المساحة بوحدة م2"
                                            value={data.real_estate_area}
                                            error={
                                                validationErrors?.real_estate_area
                                            }
                                            required
                                            onChange={(
                                                e: React.ChangeEvent<HTMLInputElement>
                                            ) =>
                                                setData(
                                                    "real_estate_area",
                                                    e.target.value
                                                )
                                            }
                                        />
                                    </div>

                                    <RequestEvaluationFormSelectInput
                                        name={"usage_id"}
                                        label="استعمال العقار"
                                        placeholder="اختر نوع الاستعمال"
                                        data={usage}
                                        value={data.usage_id}
                                        error={validationErrors?.usage_id}
                                        required
                                        onChange={(
                                            e: React.ChangeEvent<HTMLSelectElement>
                                        ) =>
                                            setData("usage_id", e.target.value)
                                        }
                                    />
                                </section>
                            )}
                            {step === 4 && (
                                <section className="w-full h-[661px] flex flex-col items-start gap-8">
                                    <UploadFIleInput
                                        radius="rounded-tl-[20px] rounded-br-[20px]"
                                        name="instrument_image"
                                        label="صورة الصك"
                                        placeholder="اختر من الملفات"
                                        value={data.instrument_image}
                                        error={
                                            validationErrors?.instrument_image
                                        }
                                        handleFileChange={(
                                            e: React.ChangeEvent<HTMLInputElement>
                                        ) =>
                                            setData(
                                                "instrument_image",
                                                // @ts-ignore
                                                e.target.files![0]
                                            )
                                        }
                                    />
                                    <UploadFIleInput
                                        radius="rounded-tl-[20px] rounded-br-[20px]"
                                        name="construction_license"
                                        label="رخصة البناء"
                                        placeholder="اختر من الملفات"
                                        value={data.construction_license}
                                        error={
                                            validationErrors?.construction_license
                                        }
                                        handleFileChange={(
                                            e: React.ChangeEvent<HTMLInputElement>
                                        ) =>
                                            setData(
                                                "construction_license",
                                                // @ts-ignore
                                                e.target.files![0]
                                            )
                                        }
                                    />
                                    <UploadFIleInput
                                        radius="rounded-tl-[20px] rounded-br-[20px]"
                                        name="other_contracts"
                                        label=" مستندات اخرى"
                                        placeholder="اختر من الملفات"
                                        value={data.other_contracts}
                                        error={
                                            validationErrors?.other_contracts
                                        }
                                        handleFileChange={(
                                            e: React.ChangeEvent<HTMLInputElement>
                                        ) =>
                                            setData(
                                                "other_contracts",
                                                // @ts-ignore
                                                e.target.files![0]
                                            )
                                        }
                                    />
                                </section>
                            )}
                            {step === 5 && (
                                <RequestSubmittedSuccessfully
                                    request_no={request_no?.toString() || ""}
                                />
                            )}
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
                </Container>
            </section>
        </>
    );
};

RequestEvaluation.layout = (page: React.ReactNode) => (
    <Layout children={page} />
);

type StepThreeProps = {
    step: number;
    data: ReturnType<
        typeof useForm<{
            estate_city: string;
            estate_region: string;
            estate_line_1: string;
            estate_line_2: string;
        }>
    >["data"];
    setData: ReturnType<
        typeof useForm<{
            estate_city: string;
            estate_region: string;
            estate_line_1: string;
            estate_line_2: string;
        }>
    >["setData"];
    validationErrors: Record<string, string>;
};
const StepThree = ({
    step,
    data,
    setData,
    validationErrors,
}: StepThreeProps) => {
    if (step !== 3) return <></>;

    return (
        <section className="w-full h-[661px] flex flex-col gap-8">
            <div className="flex gap-8">
                <Input.Text
                    required
                    name="estate_city"
                    label="المدينة"
                    placeholder="مثال: الرياض"
                    value={data.estate_city}
                    error={validationErrors?.estate_city || ""}
                    onChange={(e: React.ChangeEvent<HTMLInputElement>) =>
                        setData("estate_city", e.target.value)
                    }
                />
                <Input.Text
                    required
                    name="estate_region"
                    label="المنطقة"
                    placeholder="مثال: السليمانية"
                    value={data.estate_region}
                    error={validationErrors?.estate_region || ""}
                    onChange={(e: React.ChangeEvent<HTMLInputElement>) =>
                        setData("estate_region", e.target.value)
                    }
                />
            </div>
            <div className="flex gap-8">
                <Input.Text
                    required
                    name="estate_line_1"
                    label="العنوان 1"
                    placeholder="مثال: حي الروضة، شارع الملك فهد"
                    value={data.estate_line_1}
                    error={validationErrors?.estate_line_1 || ""}
                    onChange={(e: React.ChangeEvent<HTMLInputElement>) =>
                        setData("estate_line_1", e.target.value)
                    }
                />
                <Input.Text
                    name="estate_line_2"
                    label="العنوان 2"
                    placeholder="شقة رقم 17"
                    value={data.estate_line_2}
                    error={validationErrors?.estate_line_2 || ""}
                    onChange={(e: React.ChangeEvent<HTMLInputElement>) =>
                        setData("estate_line_2", e.target.value)
                    }
                />
            </div>
        </section>
    );
};

export default RequestEvaluation;
