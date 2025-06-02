import Container from "@/components/Container";
import { Link } from "@inertiajs/react";
import { Button, PageTopSection } from "../components";
import Layout from "./layout/Layout";

const ThanksForYourReview = () => {
    return (
        <>
            <PageTopSection title={"تهانينا"} description={"تم الدفع بنجاح"} />
            <Container>
                <div className="flex flex-col items-center justify-center py-36">
                    <p className="head-line-h5 mb-8 text-center">
                        تم اكتمال الدفع بنجاح
                    </p>
                    <Link href="/">
                        <Button>العودة إلى الصفحة الرئيسية</Button>
                    </Link>
                </div>
            </Container>
        </>
    );
};

ThanksForYourReview.layout = (page: React.ReactNode) => (
    <Layout children={page} />
);

export default ThanksForYourReview;
