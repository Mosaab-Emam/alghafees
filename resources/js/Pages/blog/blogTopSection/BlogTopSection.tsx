import Container from "@/components/Container";
import { Tag } from "@/types";
import BlogCategories from "../blogCategories/BlogCategories";
import BlogTitleBox from "./BlogTitleBox";
import SearchInBlog from "./SearchInBlog";

export default function BlogTopSection({ tags }: { tags: Array<Tag> }) {
    return (
        <Container>
            <section className="flex md:flex-row flex-col md:mb-0 mb-[50px] gap-[50px]">
                <div className="lg:w-[692px] w-full md:w-2/3 flex flex-col self-center items-start ld:gap-16 gap-8">
                    <BlogTitleBox />
                    <SearchInBlog autoSearch={true} />
                </div>
                <BlogCategories tags={tags} />
            </section>
        </Container>
    );
}
