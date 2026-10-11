import WebsiteLogo from '@/components/WebsiteLogo';
import { Head } from '@inertiajs/react';
import axios from 'axios';
import { ArrowLeft, CheckCircle2, ClipboardList, Loader2, Send } from 'lucide-react';
import { FormEvent, useRef, useState } from 'react';
import './TrainingQuestionnaire.css';

type QuestionName = 'tamheer' | 'commercial_registration' | 'social_insurance' | 'marital_status';
type FieldName = 'name' | 'email' | 'phone' | QuestionName | 'website';
type Answers = Record<FieldName, string>;
type Errors = Partial<Record<FieldName, string>>;
type Props = {
    questions: Record<QuestionName, { label: string; options: Record<string, string> }>;
};

const emptyAnswers: Answers = {
    name: '', email: '', phone: '', tamheer: '', commercial_registration: '',
    social_insurance: '', marital_status: '', website: '',
};
const personalFields = [
    { name: 'name', label: 'الاسم الكامل', type: 'text', autoComplete: 'name', placeholder: 'اكتب اسمك الكامل' },
    { name: 'email', label: 'البريد الإلكتروني', type: 'email', autoComplete: 'email', placeholder: 'name@example.com' },
    { name: 'phone', label: 'رقم الجوال', type: 'tel', autoComplete: 'tel', placeholder: '05XXXXXXXX' },
] as const;

export default function TrainingQuestionnaire({ questions }: Props) {
    const [answers, setAnswers] = useState<Answers>(emptyAnswers);
    const [errors, setErrors] = useState<Errors>({});
    const [submissionError, setSubmissionError] = useState('');
    const [sending, setSending] = useState(false);
    const [submitted, setSubmitted] = useState(false);
    const submitting = useRef(false);
    const formRef = useRef<HTMLFormElement>(null);
    const errorRef = useRef<HTMLDivElement>(null);
    const successRef = useRef<HTMLDivElement>(null);
    const questionEntries = Object.entries(questions) as [QuestionName, Props['questions'][QuestionName]][];

    const updateAnswer = (name: FieldName, value: string) => {
        setAnswers((current) => ({ ...current, [name]: value }));
        setErrors((current) => ({ ...current, [name]: undefined }));
    };

    const focusInvalidField = () => requestAnimationFrame(() => {
        formRef.current?.querySelector<HTMLElement>('[aria-invalid="true"]')?.focus();
    });

    const submit = async (event: FormEvent<HTMLFormElement>) => {
        event.preventDefault();
        if (submitting.current) return;

        const missing: Errors = {};
        personalFields.forEach(({ name, label }) => {
            if (!answers[name].trim()) missing[name] = `يرجى إدخال ${label}.`;
        });
        questionEntries.forEach(([name]) => {
            if (!answers[name]) missing[name] = 'يرجى اختيار إجابة لهذا السؤال.';
        });
        setErrors(missing);
        setSubmissionError('');
        if (Object.keys(missing).length) {
            focusInvalidField();
            return;
        }

        submitting.current = true;
        setSending(true);
        try {
            await axios.post('/training-completion', answers, {
                headers: { Accept: 'application/json' },
            });
            setSubmitted(true);
            setAnswers(emptyAnswers);
            requestAnimationFrame(() => successRef.current?.focus());
        } catch (error) {
            if (axios.isAxiosError(error) && error.response?.status === 422) {
                const validationErrors = error.response.data.errors as Record<string, string[]>;
                setErrors(Object.fromEntries(Object.entries(validationErrors).map(([key, messages]) => [key, messages[0]])));
                if (validationErrors.website) {
                    setSubmissionError(validationErrors.website[0]);
                    requestAnimationFrame(() => errorRef.current?.focus());
                } else {
                    focusInvalidField();
                }
            } else {
                let message = 'تعذر إرسال بياناتك حاليًا. بياناتك ما زالت في النموذج، يرجى المحاولة لاحقًا.';
                if (axios.isAxiosError(error)) {
                    if (error.response?.status === 429) {
                        message = 'لقد تجاوزت عدد محاولات الإرسال المسموح. يرجى الانتظار ١٠ دقائق ثم المحاولة مرة أخرى.';
                    } else if (error.response?.status === 419) {
                        message = 'انتهت صلاحية الجلسة. يرجى نسخ بياناتك ثم تحديث الصفحة وإعادة المحاولة.';
                    } else if (error.response?.status === 503 && typeof error.response.data?.message === 'string') {
                        message = error.response.data.message;
                    } else if (!error.response) {
                        message = 'تعذر الاتصال بالخادم. يرجى التحقق من اتصال الإنترنت والمحاولة مرة أخرى.';
                    }
                }
                setSubmissionError(message);
                requestAnimationFrame(() => errorRef.current?.focus());
            }
        } finally {
            submitting.current = false;
            setSending(false);
        }
    };

    return (
        <div className="training-page" dir="rtl">
            <Head>
                <meta name="robots" content="noindex, nofollow, noarchive" />
            </Head>
            <header className="training-header">
                <WebsiteLogo />
                <span className="training-header-caption">إجراءات التدريب</span>
            </header>

            <main className="training-main">
                <aside className="training-intro" aria-labelledby="training-title">
                    <span className="training-eyebrow"><ClipboardList size={20} aria-hidden="true" />خطوتك التالية</span>
                    <h1 id="training-title">استكمال <br />إجراءات <span>التدريب</span></h1>
                    <p className="training-intro-copy">يرجى تعبئة بياناتك والإجابة عن الأسئلة التالية لاستكمال إجراءات التدريب لدى شركة صالح علي الغفيص.</p>
                    <div className="training-intro-note">
                        <span className="training-note-line" aria-hidden="true" />
                        <p>تُستخدم بياناتك لاستكمال إجراءات التدريب والتواصل معك بشأن طلبك.</p>
                    </div>
                </aside>

                <section className="training-form-panel" aria-label="نموذج استكمال إجراءات التدريب">
                    {submitted ? (
                        <div className="training-success" role="status" tabIndex={-1} ref={successRef}>
                            <span className="training-success-icon"><CheckCircle2 size={42} aria-hidden="true" /></span>
                            <h2>تم إرسال بياناتك بنجاح</h2>
                            <p>شكرًا لك. تم استلام إجاباتك، وسيتواصل معك فريقنا بشأن إجراءات التدريب.</p>
                            <a href="/" className="training-submit">العودة إلى الرئيسية <ArrowLeft size={20} aria-hidden="true" /></a>
                        </div>
                    ) : (
                        <form ref={formRef} onSubmit={submit} noValidate aria-busy={sending}>
                            <div className="training-form-heading">
                                <h2>البيانات الشخصية</h2>
                                <p>جميع الحقول مطلوبة</p>
                            </div>

                            {submissionError && (
                                <div className="training-error-summary" role="alert" tabIndex={-1} ref={errorRef}>{submissionError}</div>
                            )}

                            <fieldset disabled={sending} className="training-personal-fields">
                                <legend className="sr-only">البيانات الشخصية</legend>
                                {personalFields.map(({ name, label, type, autoComplete, placeholder }) => (
                                    <div key={name} className={`training-field training-field-${name}`}>
                                        <label htmlFor={`training-${name}`}>{label}</label>
                                        <input
                                            id={`training-${name}`} name={name} type={type}
                                            value={answers[name]} onChange={(event) => updateAnswer(name, event.target.value)}
                                            autoComplete={autoComplete} placeholder={placeholder}
                                            maxLength={name === 'name' ? 150 : name === 'email' ? 254 : 32}
                                            dir={name === 'name' ? 'rtl' : 'ltr'} required
                                            aria-invalid={Boolean(errors[name])}
                                            aria-describedby={errors[name] ? `${name}-error` : undefined}
                                        />
                                        {errors[name] && <p id={`${name}-error`} className="training-field-error">{errors[name]}</p>}
                                    </div>
                                ))}
                            </fieldset>

                            <div className="training-questions-heading"><h2>معلومات التدريب</h2><span>٤ أسئلة</span></div>
                            <div className="training-questions">
                                {questionEntries.map(([name, question], index) => (
                                    <fieldset key={name} className="training-question" disabled={sending} aria-describedby={errors[name] ? `${name}-error` : undefined}>
                                        <legend>
                                            <span className="training-question-number" aria-hidden="true">{['١', '٢', '٣', '٤'][index]}</span>
                                            {question.label}
                                        </legend>
                                        <div className={`training-options ${name === 'marital_status' ? 'training-options-social' : ''}`}>
                                            {Object.entries(question.options).map(([value, label]) => (
                                                <label key={value} className="training-option">
                                                    <input
                                                        type="radio" name={name} value={value} required
                                                        checked={answers[name] === value}
                                                        onChange={() => updateAnswer(name, value)}
                                                        aria-invalid={Boolean(errors[name])}
                                                        aria-describedby={errors[name] ? `${name}-error` : undefined}
                                                    />
                                                    <span>{label}</span>
                                                </label>
                                            ))}
                                        </div>
                                        {errors[name] && <p id={`${name}-error`} className="training-field-error">{errors[name]}</p>}
                                    </fieldset>
                                ))}
                            </div>

                            <div className="training-honeypot" aria-hidden="true">
                                <label htmlFor="training-website">اترك هذا الحقل فارغًا</label>
                                <input id="training-website" name="website" type="text" tabIndex={-1} autoComplete="off" value={answers.website} onChange={(event) => updateAnswer('website', event.target.value)} />
                            </div>

                            <div className="training-form-footer">
                                <p>يرجى التأكد من صحة بياناتك قبل الإرسال.</p>
                                <button type="submit" className="training-submit" disabled={sending}>
                                    {sending ? <><Loader2 className="training-spinner" size={20} aria-hidden="true" />جارٍ الإرسال...</> : <>إرسال البيانات<Send size={18} aria-hidden="true" /></>}
                                </button>
                                <span className="sr-only" role="status">{sending ? 'جارٍ إرسال بياناتك، يرجى الانتظار.' : ''}</span>
                            </div>
                        </form>
                    )}
                </section>
            </main>
            <footer className="training-footer">شركة صالح علي الغفيص للتقييم العقاري</footer>
        </div>
    );
}
