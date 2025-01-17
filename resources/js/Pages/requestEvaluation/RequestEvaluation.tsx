import { useForm, usePage } from "@inertiajs/react";
import React, { useEffect, useState } from "react";
import {
    BgGlassFilterShape,
    MarketAnalysisShape,
    PageTopSection,
    RequestEvaluationCircleShape,
} from "../../components";
import { SelectItem } from "../../types";
import UploadFIleInput from "../joinUs/UploadFIleInput";
import Layout from "../layout/Layout";
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
}: {
    goals: Array<SelectItem>;
    types: Array<SelectItem>;
    entities: Array<SelectItem>;
    usage: Array<SelectItem>;
}) => {
    const [step, setStep] = useState(1);
    const { errors, request_no } = usePage().props;

    // Navigate to the first step that has errors
    useEffect(() => {
        if (
            errors.hasOwnProperty("name") ||
            errors.hasOwnProperty("mobile") ||
            errors.hasOwnProperty("email") ||
            errors.hasOwnProperty("address") ||
            errors.hasOwnProperty("goal_id") ||
            errors.hasOwnProperty("notes")
        ) {
            setStep(1);
        } else if (
            errors.hasOwnProperty("type_id") ||
            errors.hasOwnProperty("real_estate_details") ||
            errors.hasOwnProperty("entity_id") ||
            errors.hasOwnProperty("real_estate_age") ||
            errors.hasOwnProperty("real_estate_area") ||
            errors.hasOwnProperty("usage_id")
        ) {
            setStep(2);
        } else if (errors.hasOwnProperty("location")) {
            setStep(3);
        } else if (
            errors.hasOwnProperty("instrument_image") ||
            errors.hasOwnProperty("construction_license") ||
            errors.hasOwnProperty("other_contracts")
        ) {
            setStep(4);
        }
    }, [errors]);

    const { data, setData, post } = useForm({
        name: "",
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
        location: "",
        instrument_image: null,
        construction_license: null,
        other_contracts: null,
    });

    // handle steps
    const handlePrevStep = () => setStep(step - 1);
    const handleNextStep = () => {
        if (step === 4) {
            post("/legacy/rate-request", {
                forceFormData: true,
                preserveScroll: true,
                onSuccess: () => setStep(step + 1),
            });
        } else {
            setStep(step + 1);
        }
    };

    return (
        <>
            <PageTopSection title={"طلب تقييم"} description={"تقييم شامل"} />
            <section className="container md:mt-[211px] mt-[6rem] md:mb-0 mb-[50px] relative">
                <TextBox />
                <MarketAnalysisShape
                    position={
                        "2xl:left-80 xl:left-48 lg:left-20 -translate-x-1/2  md:top-0 top-64 z-[1]"
                    }
                />
                <BgGlassFilterShape
                    position={"md:hidden flex -right-48 top-48 z-[-1]"}
                />
                <div className="xl:w-[1200px] lg:w-[1024px] w-[360px] h-auto flex md:flex-row flex-col md:items-start items-center md:gap-[35px] gap-8  glass-effect glass-effect-bg-primary-3 rounded-tl-[100px] rounded-br-[100px] md:p-[50px]  py-8 px-6">
                    <RequestEvaluationSteps step={step} />

                    <form className="md:w-[590px] w-full flex flex-col items-start gap-8">
                        {step === 1 && (
                            <section className="w-full h-full flex flex-col items-start gap-8">
                                <RequestEvaluationFormInput
                                    type="text"
                                    label="الاسم بالكامل"
                                    name="name"
                                    value={data?.name}
                                    error={errors?.name}
                                    placeholder="ادخل اسمك بالكامل هنا"
                                    required
                                    onChange={(
                                        e: React.ChangeEvent<HTMLInputElement>
                                    ) => setData("name", e.target.value)}
                                />

                                <div className="w-full md:flex-row flex-col flex items-center self-stretch gap-[20px]">
                                    <RequestEvaluationFormInput
                                        type="tel"
                                        label="رقم الجوال"
                                        name="mobile"
                                        value={data.mobile}
                                        error={errors?.mobile}
                                        required
                                        onChange={(
                                            e: React.ChangeEvent<HTMLInputElement>
                                        ) => setData("mobile", e.target.value)}
                                        placeholder="ادخل رقم جوالك يبدأ ب 05 هنا"
                                    />

                                    <RequestEvaluationFormInput
                                        type="email"
                                        label="البريد الالكتروني"
                                        name="email"
                                        value={data.email}
                                        error={errors?.email}
                                        required
                                        onChange={(
                                            e: React.ChangeEvent<HTMLInputElement>
                                        ) => setData("email", e.target.value)}
                                        placeholder="ادخل بريدك الالكتروني هنا"
                                    />
                                </div>

                                <RequestEvaluationFormInput
                                    type="text"
                                    label="عنوان طالب التقييم"
                                    name="address"
                                    value={data.address}
                                    error={errors?.address}
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
                                    error={errors?.goal_id}
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
                                    error={errors?.notes}
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
                                    error={errors?.type_id}
                                    required
                                    onChange={(
                                        e: React.ChangeEvent<HTMLSelectElement>
                                    ) => setData("type_id", e.target.value)}
                                />

                                <RequestEvaluationFormTextArea
                                    name="real_estate_details"
                                    label="تفاصيل العقار"
                                    value={data.real_estate_details}
                                    error={errors?.real_estate_details}
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
                                    error={errors?.entity_id}
                                    onChange={(
                                        e: React.ChangeEvent<HTMLSelectElement>
                                    ) => setData("entity_id", e.target.value)}
                                />

                                <div className="w-full flex md:flex-row flex-col  items-center self-stretch gap-[20px] ">
                                    <RequestEvaluationFormInput
                                        type="number"
                                        label="العمر"
                                        name="real_estate_age"
                                        placeholder="ادخل العمر بعدد السنوات هنا"
                                        value={data.real_estate_age}
                                        error={errors?.real_estate_age}
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
                                        error={errors?.real_estate_area}
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
                                    error={errors?.usage_id}
                                    onChange={(
                                        e: React.ChangeEvent<HTMLSelectElement>
                                    ) => setData("usage_id", e.target.value)}
                                />
                            </section>
                        )}
                        {step === 3 && (
                            <section className="w-full h-[661px] flex flex-col items-start gap-8">
                                <RequestEvaluationFormTextArea
                                    name="location"
                                    label="عنوان العقار"
                                    placeholder="ادخل عنوان العقار محل التقييم كالتالي ( منطقه - الحي - المدينه ) "
                                    value={data.location}
                                    error={errors?.location}
                                    required
                                    onChange={(
                                        e: React.ChangeEvent<HTMLTextAreaElement>
                                    ) => setData("location", e.target.value)}
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
                                    error={errors?.instrument_image}
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
                                    error={errors?.construction_license}
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
                                    error={errors?.other_contracts}
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
                                request_no={request_no as string | null}
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
            </section>
        </>
    );
};

RequestEvaluation.layout = (page: React.ReactNode) => (
    <Layout children={page} />
);

export default RequestEvaluation;
