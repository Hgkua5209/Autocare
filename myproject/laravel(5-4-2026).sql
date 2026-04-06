-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2026 at 02:31 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `data`, `created_at`, `updated_at`) VALUES
(1, 'Apricot Pancake', '{\"image\":\"images\\/foods\\/apricot-pancake.jpg\",\"rating\":4,\"like\":124,\"saved\":59,\"ingredient\":[\"Apricot\",\"Egg\",\"Milk\"],\"description\":\"Autoimmune friendly pancake\",\"nutrition\":{\"calories\":\"320 kcal\",\"protein\":\"12 g\",\"carbs\":\"40 g\",\"fat\":\"10 g\"}}', '2026-01-07 01:11:27', '2026-01-08 01:40:37'),
(2, 'Egg Dim Sum', '{\"image\":\"images\\/foods\\/Egg-Dim-Sum.jpg\",\"rating\":4.5,\"like\":98,\"saved\":40,\"ingredient\":[\"Egg\",\"Rice Flour\",\"Vegetables\"],\"description\":\"Light and gut-friendly dim sum\",\"nutrition\":{\"calories\":\"180 kcal\",\"protein\":\"9 g\",\"carbs\":\"22 g\",\"fat\":\"6 g\"}}', '2026-01-07 01:11:27', '2026-01-07 01:11:27'),
(3, 'Organic Spinach & Berry Salad', '{\"image\":\"food-submissions\\/ozXZHSYIgeO4peclR91uXR1FoI6TrlP2ZW18gdeT.png\",\"ingredients\":[\"Baby Spinach\",\"Fresh Blueberries\",\"Sliced Cucumber\",\"Toasted Pumpkin Seeds\",\"Olive Oil\",\"Apple Cider Vinegar\"],\"nutrition\":{\"calories\":\"100\",\"protein\":\"6\",\"carbs\":\"18\",\"fat\":\"14\",\"fiber\":\"5\"},\"description\":\"a orgaenic salad that is nutrisiouse\",\"autoimmune_notes\":\"it is organic and has lot of benefit\",\"research\":{\"title\":\"Anti-inflammatory effects of spinach and berry polyphenols on gut microbiota\",\"source\":\"Journal of Nutritional Biochemistry\",\"url\":\"https:\\/\\/www.ncbi.nlm.nih.gov\\/pmc\\/articles\\/PMC7011600\\/\",\"summary\":\"qwertyuiopasdfghjkl;zxcvbnmqwertyuiopasdfghjklzxcvbnmqwertyuiopasdfghjklzxcvbnm\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-01-15 01:45:13', '2026-01-15 01:45:13'),
(4, 'Broccoli', '{\"image\":\"food-submissions\\/0uKp1tLFrRIVCmkfd0bttZg10TxaYDXvx17eH9R7.jpg\",\"ingredients\":[\"100% Broccoli\"],\"nutrition\":{\"calories\":\"34\",\"protein\":\"2.8\",\"carbs\":\"6.6\",\"fat\":\"0.4\",\"fiber\":\"2.6\"},\"description\":\"An edible green plant in the cabbage family.\",\"autoimmune_notes\":\"Contains sulforaphane, which helps block enzymes that cause joint destruction and inflammation.\",\"research\":{\"title\":\"Glucosinolates From Cruciferous Vegetables and Their Potential Role in Chronic Disease: Investigating the Preclinical and Clinical Evidence\",\"source\":\"Front Pharmacol. 2021 Oct 26;12:767975. doi: 10.3389\\/fphar.2021.767975. PMID: 34764875; PMCID: PMC8575925.\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC8575925\\/#:~:text=Current%20research%20suggests%20that%20glucosinolates,%2C%20and%20chemo%2Dprotective%20effects.\",\"summary\":\"An increasing body of evidence highlights the strong potential for a diet rich in fruit and vegetables to delay, and often prevent, the onset of chronic diseases, including cardiometabolic, neurological, and musculoskeletal conditions, and certain cancers. A possible protective component, glucosinolates, which are phytochemicals found almost exclusively in cruciferous vegetables, have been identified from preclinical and clinical studies. Current research suggests that glucosinolates (and isothiocyanates) act via several mechanisms, ultimately exhibiting anti-inflammatory, antioxidant, and chemo-protective effects. This review summarizes the current knowledge surrounding cruciferous vegetables and their glucosinolates in relation to the specified health conditions. Although there is evidence that consumption of a high glucosinolate diet is linked with reduced incidence of chronic diseases, future large-scale placebo-controlled human trials including standardized glucosinolate supplements are needed.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-05 04:13:31', '2026-04-05 04:13:31'),
(5, 'Sweet Potatoes', '{\"image\":\"food-submissions\\/E1cU7QB8cfxlAU1ok34ZFphqP9O8hUHWedRaglyi.jpg\",\"ingredients\":[\"100% Sweet Potato\"],\"nutrition\":{\"calories\":\"86\",\"protein\":\"1.6\",\"carbs\":\"20\",\"fat\":\"0.1\",\"fiber\":\"3\"},\"description\":\"A starchy root vegetable (not a nightshade like white potatoes).\",\"autoimmune_notes\":\"High in Beta-carotene and fiber, which helps regulate the immune system and maintains a healthy weight.\",\"research\":{\"title\":\"Anthocyanins From Sweet Potatoes (Ipomoea batatas): Bioavailability, Mechanisms of Action, and Therapeutic Potential in Diabetes and Metabolic Disorders\",\"source\":\"Bioavailability, Mechanisms of Action, and Therapeutic Potential in Diabetes and Metabolic Disorders. Food Sci Nutr. 2025 Sep 4;13(9):e70895. doi: 10.1002\\/fsn3.70895. PMID: 40918166; PMCID: PMC12409302.\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12409302\\/#:~:text=In%20addition%2C%20anthocyanins%20inhibit%20low,progression%20of%20type%202%20diabetes.\",\"summary\":\"Ipomoea batatas , commonly known as sweet potato, is an increasingly valued functional food because of its vivid coloration and rich bioactive compounds, especially anthocyanins and carotenoids, such as ipomoeaxanthin. This review focuses on the bioavailability, mechanisms of action, and therapeutic potential of sweet potato\\u2010derived anthocyanins in diabetes and metabolic disorders. Anthocyanins, which are plant pigments, exhibit high antioxidant activity by scavenging free radicals and stimulating endogenous antioxidant enzymes such as catalase and superoxide dismutase, thereby protecting cellular structures from damage and reducing oxidative damage in vital metabolic organs such as the pancreas, liver, brain, and muscles. Anthocyanins also increase insulin sensitivity, regulate glucose metabolism, and regulate enzymes involved in carbohydrate digestion, thus reducing the risk of diabetes. In addition, anthocyanins inhibit low\\u2010grade chronic inflammation by inhibiting the inflammatory mediators TNF\\u2010\\u03b1, IL\\u20106, and NF\\u2010\\u03baB signaling pathways implicated in the progression of type 2 diabetes. Clinical evidence supports preclinical animal models and ongoing human trials favoring sweet potato consumption to enhance glucose control and decrease insulin resistance. However, challenges remain regarding the poor bioavailability of anthocyanins and the need for stronger human studies. In addition to anthocyanins, sweet potatoes contain diverse nutrients that contribute to their metabolic health. This review highlights the significance of sweet potatoes as a functional food ingredient in diabetes prevention diets and encourages new processing methods that can sustain their bioactive potential.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-05 04:13:40', '2026-04-05 04:13:40'),
(6, 'Sauerkraut (Fermented Cabbage)', '{\"image\":\"food-submissions\\/tByErDlDizAAdp6KUSRi0G0AHGAjseCd0j21xAL6.jpg\",\"ingredients\":[\"Cabbage\",\"sea salt (ensure no vinegar\\/preservatives).\"],\"nutrition\":{\"calories\":\"19\",\"protein\":\"0.9\",\"carbs\":\"4.3\",\"fat\":\"0.1\",\"fiber\":\"2.9\"},\"description\":\"Finely cut cabbage fermented by various lactic acid bacteria.\",\"autoimmune_notes\":\"Provides probiotics that strengthen the intestinal barrier, essential for regulating immune responses.\",\"research\":{\"title\":\"Fermented Foods, Health and the Gut Microbiome\",\"source\":\"Nutrients. 2022 Apr 6;14(7):1527. doi: 10.3390\\/nu14071527. PMID: 35406140; PMCID: PMC9003261.\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC9003261\\/#:~:text=This%20review%20clearly%20shows%20that,element%20of%20the%20human%20diet.\",\"summary\":\"Fermented foods have been a part of human diet for almost 10,000 years, and their level of diversity in the 21st century is substantial. The health benefits of fermented foods have been intensively investigated; identification of bioactive peptides and microbial metabolites in fermented foods that can positively affect human health has consolidated this interest. Each fermented food typically hosts a distinct population of microorganisms. Once ingested, nutrients and microorganisms from fermented foods may survive to interact with the gut microbiome, which can now be resolved at the species and strain level by metagenomics. Transient or long-term colonization of the gut by fermented food strains or impacts of fermented foods on indigenous gut microbes can therefore be determined. This review considers the primary food fermentation pathways and microorganisms involved, the potential health benefits, and the ability of these foodstuffs to impact the gut microbiome once ingested either through compounds produced during the fermentation process or through interactions with microorganisms from the fermented food that are capable of surviving in the gastro-intestinal transit. This review clearly shows that fermented foods can affect the gut microbiome in both the short and long term, and should be considered an important element of the human diet.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-05 04:13:46', '2026-04-05 04:13:46'),
(7, 'Kale', '{\"image\":\"food-submissions\\/iOhwxquqYf4qZx3h4xMKvNLJoN4NDiFQo6niC8K8.jpg\",\"ingredients\":[\"100% Kale\"],\"nutrition\":{\"calories\":\"43\",\"protein\":\"3.3\",\"carbs\":\"8.8\",\"fat\":\"0.9\",\"fiber\":\"3.6\"},\"description\":\"A nutrient-dense cruciferous leafy green.\",\"autoimmune_notes\":\"High in Vitamin K and antioxidants that protect cells from the DNA damage associated with chronic inflammation.\",\"research\":{\"title\":\"Foods that fight inflammation\",\"source\":\"Editorial Advisory Board Member, Harvard Health Publishing\",\"url\":\"https:\\/\\/www.health.harvard.edu\\/healthy-aging-and-longevity\\/foods-that-fight-inflammation#:~:text=On%20the%20flip%20side%20are,protective%20compounds%20found%20in%20plants.\",\"summary\":\"What does an anti-inflammatory diet do? Your immune system becomes activated when your body recognizes anything that is foreign-such as an invading microbe, plant pollen, or chemical. This often triggers a process called inflammation. Intermittent bouts of inflammation directed at truly threatening invaders protect your health.\\r\\n\\r\\nHowever, sometimes inflammation persists, day in and day out, even when you are not threatened by a foreign invader. That\'s when inflammation can become your enemy. Many major diseases that plague us - including cancer, heart disease, diabetes, arthritis, depression, and Alzheimer\'s - have been linked to chronic inflammation.\\r\\n\\r\\nOne of the most powerful tools to combat inflammation comes not from the pharmacy, but from the grocery store. \\\"Many experimental studies have shown that components of foods or beverages may have anti-inflammatory effects,\\\" says Dr. Frank Hu, professor of nutrition and epidemiology in the Department of Nutrition at the Harvard School of Public Health.\\r\\n\\r\\nChoose the right anti-inflammatory foods, and you may be able to reduce your risk of illness. Consistently pick the wrong ones, and you could accelerate the inflammatory disease process.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-05 04:13:52', '2026-04-05 04:13:52'),
(8, 'Extra Virgin Olive Oil', '{\"image\":\"food-submissions\\/JN538UAlXyBf0NEFhG3odXyQ2WoXwNyN3QfGOnNr.jpg\",\"ingredients\":[\"100% Extra Virgin Olive Oil.\"],\"nutrition\":{\"calories\":\"119\",\"protein\":\"0\",\"carbs\":\"0\",\"fat\":\"14\",\"fiber\":\"0\"},\"description\":\"A high-quality oil extracted from olives using only pressure.\",\"autoimmune_notes\":\"Contains oleocanthal, which has a similar effect to ibuprofen, and polyphenols that support beneficial gut bacteria.\",\"research\":{\"title\":\"11 Proven Benefits of Olive Oil\",\"source\":\"Medically reviewed by Amy Richter, MS, RD \\u2014 Written by Joe Leech, MS \\u2014 Updated on June 3, 2024\",\"url\":\"https:\\/\\/www.healthline.com\\/nutrition\\/11-proven-benefits-of-olive-oil#:~:text=The%20antioxidants%20mediate%20the%20main,a%20nonsteroidal%20anti%2Dinflammatory%20drug.\",\"summary\":\"Olive oil may offer several health benefits, such as antioxidants, healthy fats, and anti-inflammatory properties, among others.\\r\\n\\r\\nThe health effects of dietary fat are controversial.\\r\\n\\r\\nHowever, experts agree that olive oil \\u2014 especially extra virgin \\u2014 is good for you.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-05 04:13:57', '2026-04-05 04:13:57'),
(9, 'Bone Broth', '{\"image\":\"food-submissions\\/OUvvsraxVNkPY5KsTekjqqiTB9G1HoAFl8l1Lmx4.jpg\",\"ingredients\":[\"Beef\\/Chicken bones\",\"water\",\"apple cider vinegar\",\"herbs.\"],\"nutrition\":{\"calories\":\"40\",\"protein\":\"9\",\"carbs\":\"0\",\"fat\":\"1\",\"fiber\":\"0\"},\"description\":\"A savory liquid made from simmering animal bones and connective tissue.\",\"autoimmune_notes\":\"Rich in glycine and glutamine, which help repair the gut lining (\\\"leaky gut\\\"), often a precursor to autoimmune flares.\",\"research\":{\"title\":\"Bone Broth Strengthens Gut Barrier and Reduces Intestinal Inflammation\",\"source\":\"Matar A et al. Bone Broth Benefits: How Its Nutrients Fortify Gut Barrier in Health and Disease. Dig Dis Sci. 2025;70:1951-61.\",\"url\":\"https:\\/\\/www.emjreviews.com\\/gastroenterology\\/news\\/bone-broth-strengthens-gut-barrier-and-reduces-intestinal-inflammation\\/#:~:text=Behind%20the%20Benefits.-,Bone%20broth%20is%20rich%20in%20key%20amino%20acids%20such%20as,integrity%20of%20the%20gut%20barrier.\",\"summary\":\"Ancient Remedy, Modern Science\\r\\nResearchers from the Mayo Clinic, including lead author Michael Camilleri, analyzed animal and human studies to explore how the nutritional components of bone broth affect the intestinal barrier, inflammation, and digestive disorders such as inflammatory bowel disease (IBD). Their findings suggest that bone broth is more than just a wellness trend: its composition of amino acids and minerals may actively promote gut healing and strengthen the intestinal lining.\\r\\n\\r\\nAmino Acids and Minerals Behind the Benefits\\r\\nBone broth is rich in key amino acids such as glutamine, glycine, proline, histidine, and arginine, all of which have been shown to support cellular repair and maintain the integrity of the gut barrier. It also contains essential minerals including calcium, phosphorus, potassium, magnesium, and zinc, which contribute to overall digestive and metabolic function. Together, these nutrients appear to reduce intestinal permeability (\\u201cleaky gut\\u201d) and help regulate inflammation, particularly in individuals with IBD.\\r\\n\\r\\n\\u201cBone broth\\u2019s composition provides a nutrient-dense, natural source of gut-protective compounds,\\u201d the authors wrote. \\u201cIts amino acid and mineral content have demonstrable effects on the intestinal barrier and may support remission maintenance in inflammatory bowel conditions.\\u201d\\r\\n\\r\\nA Potential Complement to Modern Therapies\\r\\nThe review highlights how bone broth could serve as a functional food for patients with chronic gut inflammation, improving both nutrient absorption and mucosal integrity. However, the authors caution that while preliminary evidence is promising, clinical trials are still needed to determine its efficacy as a therapeutic intervention.\\r\\n\\r\\nFuture Directions for Gut Health Research\\r\\nOverall, the findings lend scientific credibility to a long-held belief,  that slow-simmered bone broth can indeed nurture the gut. The researchers encourage further investigation into how this traditional food could complement modern treatments for IBD, functional diarrhea, and other gastrointestinal conditions.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-05 04:14:03', '2026-04-05 04:14:03'),
(10, 'Turmeric (with Black Pepper)', '{\"image\":\"food-submissions\\/oXIwzmNeuQF1myaYCVbRjr4x7jimqZiDhqwiAbCn.jpg\",\"ingredients\":[\"Turmeric root or powder\"],\"nutrition\":{\"calories\":\"9\",\"protein\":\"0.3\",\"carbs\":\"2\",\"fat\":\"0.1\",\"fiber\":\"0.6\"},\"description\":\"A vibrant spice containing the active compound curcumin.\",\"autoimmune_notes\":\"Curcumin is a potent natural anti-inflammatory that modulates the immune system by inhibiting TNF-a and IL-6\",\"research\":{\"title\":\"Re: Clinical Review of Curcumin in Autoimmune and Rheumatic Diseases\",\"source\":\"Yang M, Akbar U, Mohan C. Curcumin in autoimmune and rheumatic diseases. Nutrients. May 2019;11:1004. pii: E1004. doi:10.3390\\/nu11051004.\",\"url\":\"https:\\/\\/www.herbalgram.org\\/resources\\/herbclip\\/issues\\/2019\\/bin_620\\/061951-620\\/\",\"summary\":\"Turmeric (Curcuma longa syn C. domestica, Zingiberaceae) rhizome has been used medicinally for thousands of years. The curcuminoid constituents of turmeric have demonstrated anti-inflammatory, anti-oxidant, and anti-diabetic properties. Curcumin is the most abundant curcuminoid constituent of turmeric, followed by demethoxycurcumin (DMC) and bisdesmethoxycurcumin (BDMC). In the biomedical literature (and in this article), the term curcumin is often used as a generic name for any type of medicinal turmeric preparation, including turmeric rhizome powder and a wide range of curcuminoid extracts. The purpose of this review article was to examine randomized, controlled trials (RCTs) of \\\"curcumin\\\" in the treatment of autoimmune and rheumatic diseases.\\r\\n\\r\\nPubMed was searched using the following keywords: (curcumin or curcuminoid or curcuma) AND (osteoarthritis or type 2 diabetes or ulcerative colitis or lupus nephritis or rheumatoid arthritis or multiple sclerosis). The inclusion criteria were as follows: (1) full text English language publication, (2) randomized trial, (3) included a control group, and (4) quantifiable daily oral dose of curcumin. A total of 32 RCTs met the inclusion criteria. The time period searched was not reported; however, with the exception of one study published in 2002, the included RCTs were published between 2008 and 2018.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-05 04:14:09', '2026-04-05 04:14:09'),
(11, 'Blueberries', '{\"image\":\"food-submissions\\/b6OclWRoZyTzz7fPW1a6pLxO1o9zezskpwFm6VQv.jpg\",\"ingredients\":[\"100% Blueberries\"],\"nutrition\":{\"calories\":\"57\",\"protein\":\"0.7\",\"carbs\":\"14\",\"fat\":\"2.4\",\"fiber\":\"0.3\"},\"description\":\"A low-glycemic fruit packed with anthocyanins.\",\"autoimmune_notes\":\"They block NF-kB signaling, a primary pathway for inflammation, and reduce oxidative stress.\",\"research\":{\"title\":\"Beneficial Effects of Blueberries in Experimental Autoimmune Encephalomyelitis\",\"source\":\"J. Agric. Food Chem. 2012, 60, 23, 5743\\u20135748\",\"url\":\"https:\\/\\/pubs.acs.org\\/doi\\/10.1021\\/jf203611t#:~:text=This%20study%20investigated%20whether%20blueberries,model%20(p%20%3C%200.01).\",\"summary\":\"Experimental autoimmune encephalomyelitis (EAE) is an animal model of autoimmune disease that presents with pathological and clinical features similar to those of multiple sclerosis (MS) including inflammation and neurodegeneration. This study investigated whether blueberries, which possess immunomodulatory, anti-inflammatory, and neuroprotective properties, could provide protection in EAE. Dietary supplementation with 1% whole, freeze-dried blueberries reduced disease incidence by >50% in a chronic EAE model (p < 0.01). When blueberry-fed mice with EAE were compared with control-fed mice with EAE, blueberry-fed mice had significantly lower motor disability scores (p = 0.03) as well as significantly greater myelin preservation in the lumbar spinal cord (p = 0.04). In a relapsing\\u2013remitting EAE model, blueberry-supplemented mice showed improved cumulative and final motor scores compared to control diet-fed mice (p = 0.01 and 0.03, respectively). These data demonstrate that blueberry supplementation is beneficial in multiple EAE models, suggesting that blueberries, which are easily administered orally and well-tolerated, may provide benefit to MS patients.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-05 04:14:14', '2026-04-05 04:14:14'),
(12, 'Wild Caught Salmon', '{\"image\":\"food-submissions\\/mPHkGanp5vjX3kZxwrQPbskBRDxzgDMaZTsXNax4.webp\",\"ingredients\":[\"100% Salmon\"],\"nutrition\":{\"calories\":\"208\",\"protein\":\"20\",\"carbs\":\"0\",\"fat\":\"13\",\"fiber\":\"0\"},\"description\":\"A fatty fish known for its high concentration of long-chain omega-3 fatty acids.\",\"autoimmune_notes\":\"Omega-3s ($EPA$ and $DHA$) interfere with the synthesis of pro-inflammatory cytokines and help resolve inflammation.\",\"research\":{\"title\":\"Mendivil CO (2021) Dietary Fish, Fish Nutrients, and Immune Function: A Review\",\"source\":\"Front. Nutr. 7:617652. doi: 10.3389\\/fnut.2020.617652\",\"url\":\"https:\\/\\/www.frontiersin.org\\/journals\\/nutrition\\/articles\\/10.3389\\/fnut.2020.617652\\/full\",\"summary\":\"Dietary habits have a major impact on the development and function of the immune system. This impact is mediated both by the intrinsic nutritional and biochemical qualities of the diet, and by its influence on the intestinal microbiota. Fish as a food is rich in compounds with immunoregulatory properties, among them omega-3 fatty acids, melatonin, tryptophan, taurine and polyamines. In addition, regular fish consumption favors the proliferation of beneficial members of the intestinal microbiota, like short-chain fatty acid-producing bacteria. By substituting arachidonic acid in the eicosanoid biosynthesis pathway, long-chain omega-3 fatty acids from fish change the type of prostaglandins, leukotrienes and thromboxanes being produced, resulting in anti-inflammatory properties. Further, they also are substrates for the production of specialized pro-resolving mediators (SPMs) (resolvins, protectins, and maresins), lipid compounds that constitute the physiological feedback signal to stop inflammation and give way to tissue reparation. Evidence from human observational and interventional studies shows that regular fish consumption is associated with reduced incidence of chronic inflammatory conditions like rheumatoid arthritis, and that continuous infusion of fish oil to tube-fed, critically ill patients may improve important outcomes in the ICU. There is also evidence from animal models showing that larger systemic concentrations of omega-3 fatty acids may counter the pathophysiological cascade that leads to psoriasis. The knowledge gained over the last few decades merits future exploration of the potential role of fish and its components in other conditions characterized by deregulated activation of immune cells and a cytokine storm like viral sepsis or COVID-19.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', '2026-04-05 04:14:19', '2026-04-05 04:14:19');

-- --------------------------------------------------------

--
-- Table structure for table `food_submissions`
--

CREATE TABLE `food_submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`)),
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `rejection_reason` text DEFAULT NULL,
  `admin_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_submissions`
--

INSERT INTO `food_submissions` (`id`, `user_id`, `name`, `type`, `data`, `status`, `rejection_reason`, `admin_note`, `created_at`, `updated_at`) VALUES
(1, 2, 'Organic Spinach & Berry Salad', 'food', '{\"image\":\"food-submissions\\/ozXZHSYIgeO4peclR91uXR1FoI6TrlP2ZW18gdeT.png\",\"ingredients\":[\"Baby Spinach\",\"Fresh Blueberries\",\"Sliced Cucumber\",\"Toasted Pumpkin Seeds\",\"Olive Oil\",\"Apple Cider Vinegar\"],\"nutrition\":{\"calories\":\"100\",\"protein\":\"6\",\"carbs\":\"18\",\"fat\":\"14\",\"fiber\":\"5\"},\"description\":\"a orgaenic salad that is nutrisiouse\",\"autoimmune_notes\":\"it is organic and has lot of benefit\",\"research\":{\"title\":\"Anti-inflammatory effects of spinach and berry polyphenols on gut microbiota\",\"source\":\"Journal of Nutritional Biochemistry\",\"url\":\"https:\\/\\/www.ncbi.nlm.nih.gov\\/pmc\\/articles\\/PMC7011600\\/\",\"summary\":\"qwertyuiopasdfghjkl;zxcvbnmqwertyuiopasdfghjklzxcvbnmqwertyuiopasdfghjklzxcvbnm\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-01-15 01:42:01', '2026-01-15 01:45:13'),
(2, 1, 'Wild Caught Salmon', 'food', '{\"image\":\"food-submissions\\/mPHkGanp5vjX3kZxwrQPbskBRDxzgDMaZTsXNax4.webp\",\"ingredients\":[\"100% Salmon\"],\"nutrition\":{\"calories\":\"208\",\"protein\":\"20\",\"carbs\":\"0\",\"fat\":\"13\",\"fiber\":\"0\"},\"description\":\"A fatty fish known for its high concentration of long-chain omega-3 fatty acids.\",\"autoimmune_notes\":\"Omega-3s ($EPA$ and $DHA$) interfere with the synthesis of pro-inflammatory cytokines and help resolve inflammation.\",\"research\":{\"title\":\"Mendivil CO (2021) Dietary Fish, Fish Nutrients, and Immune Function: A Review\",\"source\":\"Front. Nutr. 7:617652. doi: 10.3389\\/fnut.2020.617652\",\"url\":\"https:\\/\\/www.frontiersin.org\\/journals\\/nutrition\\/articles\\/10.3389\\/fnut.2020.617652\\/full\",\"summary\":\"Dietary habits have a major impact on the development and function of the immune system. This impact is mediated both by the intrinsic nutritional and biochemical qualities of the diet, and by its influence on the intestinal microbiota. Fish as a food is rich in compounds with immunoregulatory properties, among them omega-3 fatty acids, melatonin, tryptophan, taurine and polyamines. In addition, regular fish consumption favors the proliferation of beneficial members of the intestinal microbiota, like short-chain fatty acid-producing bacteria. By substituting arachidonic acid in the eicosanoid biosynthesis pathway, long-chain omega-3 fatty acids from fish change the type of prostaglandins, leukotrienes and thromboxanes being produced, resulting in anti-inflammatory properties. Further, they also are substrates for the production of specialized pro-resolving mediators (SPMs) (resolvins, protectins, and maresins), lipid compounds that constitute the physiological feedback signal to stop inflammation and give way to tissue reparation. Evidence from human observational and interventional studies shows that regular fish consumption is associated with reduced incidence of chronic inflammatory conditions like rheumatoid arthritis, and that continuous infusion of fish oil to tube-fed, critically ill patients may improve important outcomes in the ICU. There is also evidence from animal models showing that larger systemic concentrations of omega-3 fatty acids may counter the pathophysiological cascade that leads to psoriasis. The knowledge gained over the last few decades merits future exploration of the potential role of fish and its components in other conditions characterized by deregulated activation of immune cells and a cytokine storm like viral sepsis or COVID-19.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-05 03:38:07', '2026-04-05 04:14:19'),
(3, 1, 'Blueberries', 'food', '{\"image\":\"food-submissions\\/b6OclWRoZyTzz7fPW1a6pLxO1o9zezskpwFm6VQv.jpg\",\"ingredients\":[\"100% Blueberries\"],\"nutrition\":{\"calories\":\"57\",\"protein\":\"0.7\",\"carbs\":\"14\",\"fat\":\"2.4\",\"fiber\":\"0.3\"},\"description\":\"A low-glycemic fruit packed with anthocyanins.\",\"autoimmune_notes\":\"They block NF-kB signaling, a primary pathway for inflammation, and reduce oxidative stress.\",\"research\":{\"title\":\"Beneficial Effects of Blueberries in Experimental Autoimmune Encephalomyelitis\",\"source\":\"J. Agric. Food Chem. 2012, 60, 23, 5743\\u20135748\",\"url\":\"https:\\/\\/pubs.acs.org\\/doi\\/10.1021\\/jf203611t#:~:text=This%20study%20investigated%20whether%20blueberries,model%20(p%20%3C%200.01).\",\"summary\":\"Experimental autoimmune encephalomyelitis (EAE) is an animal model of autoimmune disease that presents with pathological and clinical features similar to those of multiple sclerosis (MS) including inflammation and neurodegeneration. This study investigated whether blueberries, which possess immunomodulatory, anti-inflammatory, and neuroprotective properties, could provide protection in EAE. Dietary supplementation with 1% whole, freeze-dried blueberries reduced disease incidence by >50% in a chronic EAE model (p < 0.01). When blueberry-fed mice with EAE were compared with control-fed mice with EAE, blueberry-fed mice had significantly lower motor disability scores (p = 0.03) as well as significantly greater myelin preservation in the lumbar spinal cord (p = 0.04). In a relapsing\\u2013remitting EAE model, blueberry-supplemented mice showed improved cumulative and final motor scores compared to control diet-fed mice (p = 0.01 and 0.03, respectively). These data demonstrate that blueberry supplementation is beneficial in multiple EAE models, suggesting that blueberries, which are easily administered orally and well-tolerated, may provide benefit to MS patients.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-05 03:42:48', '2026-04-05 04:14:14'),
(4, 1, 'Turmeric (with Black Pepper)', 'food', '{\"image\":\"food-submissions\\/oXIwzmNeuQF1myaYCVbRjr4x7jimqZiDhqwiAbCn.jpg\",\"ingredients\":[\"Turmeric root or powder\"],\"nutrition\":{\"calories\":\"9\",\"protein\":\"0.3\",\"carbs\":\"2\",\"fat\":\"0.1\",\"fiber\":\"0.6\"},\"description\":\"A vibrant spice containing the active compound curcumin.\",\"autoimmune_notes\":\"Curcumin is a potent natural anti-inflammatory that modulates the immune system by inhibiting TNF-a and IL-6\",\"research\":{\"title\":\"Re: Clinical Review of Curcumin in Autoimmune and Rheumatic Diseases\",\"source\":\"Yang M, Akbar U, Mohan C. Curcumin in autoimmune and rheumatic diseases. Nutrients. May 2019;11:1004. pii: E1004. doi:10.3390\\/nu11051004.\",\"url\":\"https:\\/\\/www.herbalgram.org\\/resources\\/herbclip\\/issues\\/2019\\/bin_620\\/061951-620\\/\",\"summary\":\"Turmeric (Curcuma longa syn C. domestica, Zingiberaceae) rhizome has been used medicinally for thousands of years. The curcuminoid constituents of turmeric have demonstrated anti-inflammatory, anti-oxidant, and anti-diabetic properties. Curcumin is the most abundant curcuminoid constituent of turmeric, followed by demethoxycurcumin (DMC) and bisdesmethoxycurcumin (BDMC). In the biomedical literature (and in this article), the term curcumin is often used as a generic name for any type of medicinal turmeric preparation, including turmeric rhizome powder and a wide range of curcuminoid extracts. The purpose of this review article was to examine randomized, controlled trials (RCTs) of \\\"curcumin\\\" in the treatment of autoimmune and rheumatic diseases.\\r\\n\\r\\nPubMed was searched using the following keywords: (curcumin or curcuminoid or curcuma) AND (osteoarthritis or type 2 diabetes or ulcerative colitis or lupus nephritis or rheumatoid arthritis or multiple sclerosis). The inclusion criteria were as follows: (1) full text English language publication, (2) randomized trial, (3) included a control group, and (4) quantifiable daily oral dose of curcumin. A total of 32 RCTs met the inclusion criteria. The time period searched was not reported; however, with the exception of one study published in 2002, the included RCTs were published between 2008 and 2018.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-05 03:47:11', '2026-04-05 04:14:09'),
(5, 1, 'Bone Broth', 'food', '{\"image\":\"food-submissions\\/OUvvsraxVNkPY5KsTekjqqiTB9G1HoAFl8l1Lmx4.jpg\",\"ingredients\":[\"Beef\\/Chicken bones\",\"water\",\"apple cider vinegar\",\"herbs.\"],\"nutrition\":{\"calories\":\"40\",\"protein\":\"9\",\"carbs\":\"0\",\"fat\":\"1\",\"fiber\":\"0\"},\"description\":\"A savory liquid made from simmering animal bones and connective tissue.\",\"autoimmune_notes\":\"Rich in glycine and glutamine, which help repair the gut lining (\\\"leaky gut\\\"), often a precursor to autoimmune flares.\",\"research\":{\"title\":\"Bone Broth Strengthens Gut Barrier and Reduces Intestinal Inflammation\",\"source\":\"Matar A et al. Bone Broth Benefits: How Its Nutrients Fortify Gut Barrier in Health and Disease. Dig Dis Sci. 2025;70:1951-61.\",\"url\":\"https:\\/\\/www.emjreviews.com\\/gastroenterology\\/news\\/bone-broth-strengthens-gut-barrier-and-reduces-intestinal-inflammation\\/#:~:text=Behind%20the%20Benefits.-,Bone%20broth%20is%20rich%20in%20key%20amino%20acids%20such%20as,integrity%20of%20the%20gut%20barrier.\",\"summary\":\"Ancient Remedy, Modern Science\\r\\nResearchers from the Mayo Clinic, including lead author Michael Camilleri, analyzed animal and human studies to explore how the nutritional components of bone broth affect the intestinal barrier, inflammation, and digestive disorders such as inflammatory bowel disease (IBD). Their findings suggest that bone broth is more than just a wellness trend: its composition of amino acids and minerals may actively promote gut healing and strengthen the intestinal lining.\\r\\n\\r\\nAmino Acids and Minerals Behind the Benefits\\r\\nBone broth is rich in key amino acids such as glutamine, glycine, proline, histidine, and arginine, all of which have been shown to support cellular repair and maintain the integrity of the gut barrier. It also contains essential minerals including calcium, phosphorus, potassium, magnesium, and zinc, which contribute to overall digestive and metabolic function. Together, these nutrients appear to reduce intestinal permeability (\\u201cleaky gut\\u201d) and help regulate inflammation, particularly in individuals with IBD.\\r\\n\\r\\n\\u201cBone broth\\u2019s composition provides a nutrient-dense, natural source of gut-protective compounds,\\u201d the authors wrote. \\u201cIts amino acid and mineral content have demonstrable effects on the intestinal barrier and may support remission maintenance in inflammatory bowel conditions.\\u201d\\r\\n\\r\\nA Potential Complement to Modern Therapies\\r\\nThe review highlights how bone broth could serve as a functional food for patients with chronic gut inflammation, improving both nutrient absorption and mucosal integrity. However, the authors caution that while preliminary evidence is promising, clinical trials are still needed to determine its efficacy as a therapeutic intervention.\\r\\n\\r\\nFuture Directions for Gut Health Research\\r\\nOverall, the findings lend scientific credibility to a long-held belief,  that slow-simmered bone broth can indeed nurture the gut. The researchers encourage further investigation into how this traditional food could complement modern treatments for IBD, functional diarrhea, and other gastrointestinal conditions.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-05 03:50:16', '2026-04-05 04:14:03'),
(6, 1, 'Extra Virgin Olive Oil', 'food', '{\"image\":\"food-submissions\\/JN538UAlXyBf0NEFhG3odXyQ2WoXwNyN3QfGOnNr.jpg\",\"ingredients\":[\"100% Extra Virgin Olive Oil.\"],\"nutrition\":{\"calories\":\"119\",\"protein\":\"0\",\"carbs\":\"0\",\"fat\":\"14\",\"fiber\":\"0\"},\"description\":\"A high-quality oil extracted from olives using only pressure.\",\"autoimmune_notes\":\"Contains oleocanthal, which has a similar effect to ibuprofen, and polyphenols that support beneficial gut bacteria.\",\"research\":{\"title\":\"11 Proven Benefits of Olive Oil\",\"source\":\"Medically reviewed by Amy Richter, MS, RD \\u2014 Written by Joe Leech, MS \\u2014 Updated on June 3, 2024\",\"url\":\"https:\\/\\/www.healthline.com\\/nutrition\\/11-proven-benefits-of-olive-oil#:~:text=The%20antioxidants%20mediate%20the%20main,a%20nonsteroidal%20anti%2Dinflammatory%20drug.\",\"summary\":\"Olive oil may offer several health benefits, such as antioxidants, healthy fats, and anti-inflammatory properties, among others.\\r\\n\\r\\nThe health effects of dietary fat are controversial.\\r\\n\\r\\nHowever, experts agree that olive oil \\u2014 especially extra virgin \\u2014 is good for you.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-05 03:54:20', '2026-04-05 04:13:57'),
(7, 1, 'Kale', 'food', '{\"image\":\"food-submissions\\/iOhwxquqYf4qZx3h4xMKvNLJoN4NDiFQo6niC8K8.jpg\",\"ingredients\":[\"100% Kale\"],\"nutrition\":{\"calories\":\"43\",\"protein\":\"3.3\",\"carbs\":\"8.8\",\"fat\":\"0.9\",\"fiber\":\"3.6\"},\"description\":\"A nutrient-dense cruciferous leafy green.\",\"autoimmune_notes\":\"High in Vitamin K and antioxidants that protect cells from the DNA damage associated with chronic inflammation.\",\"research\":{\"title\":\"Foods that fight inflammation\",\"source\":\"Editorial Advisory Board Member, Harvard Health Publishing\",\"url\":\"https:\\/\\/www.health.harvard.edu\\/healthy-aging-and-longevity\\/foods-that-fight-inflammation#:~:text=On%20the%20flip%20side%20are,protective%20compounds%20found%20in%20plants.\",\"summary\":\"What does an anti-inflammatory diet do? Your immune system becomes activated when your body recognizes anything that is foreign-such as an invading microbe, plant pollen, or chemical. This often triggers a process called inflammation. Intermittent bouts of inflammation directed at truly threatening invaders protect your health.\\r\\n\\r\\nHowever, sometimes inflammation persists, day in and day out, even when you are not threatened by a foreign invader. That\'s when inflammation can become your enemy. Many major diseases that plague us - including cancer, heart disease, diabetes, arthritis, depression, and Alzheimer\'s - have been linked to chronic inflammation.\\r\\n\\r\\nOne of the most powerful tools to combat inflammation comes not from the pharmacy, but from the grocery store. \\\"Many experimental studies have shown that components of foods or beverages may have anti-inflammatory effects,\\\" says Dr. Frank Hu, professor of nutrition and epidemiology in the Department of Nutrition at the Harvard School of Public Health.\\r\\n\\r\\nChoose the right anti-inflammatory foods, and you may be able to reduce your risk of illness. Consistently pick the wrong ones, and you could accelerate the inflammatory disease process.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-05 03:57:29', '2026-04-05 04:13:52'),
(8, 1, 'Sauerkraut (Fermented Cabbage)', 'food', '{\"image\":\"food-submissions\\/tByErDlDizAAdp6KUSRi0G0AHGAjseCd0j21xAL6.jpg\",\"ingredients\":[\"Cabbage\",\"sea salt (ensure no vinegar\\/preservatives).\"],\"nutrition\":{\"calories\":\"19\",\"protein\":\"0.9\",\"carbs\":\"4.3\",\"fat\":\"0.1\",\"fiber\":\"2.9\"},\"description\":\"Finely cut cabbage fermented by various lactic acid bacteria.\",\"autoimmune_notes\":\"Provides probiotics that strengthen the intestinal barrier, essential for regulating immune responses.\",\"research\":{\"title\":\"Fermented Foods, Health and the Gut Microbiome\",\"source\":\"Nutrients. 2022 Apr 6;14(7):1527. doi: 10.3390\\/nu14071527. PMID: 35406140; PMCID: PMC9003261.\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC9003261\\/#:~:text=This%20review%20clearly%20shows%20that,element%20of%20the%20human%20diet.\",\"summary\":\"Fermented foods have been a part of human diet for almost 10,000 years, and their level of diversity in the 21st century is substantial. The health benefits of fermented foods have been intensively investigated; identification of bioactive peptides and microbial metabolites in fermented foods that can positively affect human health has consolidated this interest. Each fermented food typically hosts a distinct population of microorganisms. Once ingested, nutrients and microorganisms from fermented foods may survive to interact with the gut microbiome, which can now be resolved at the species and strain level by metagenomics. Transient or long-term colonization of the gut by fermented food strains or impacts of fermented foods on indigenous gut microbes can therefore be determined. This review considers the primary food fermentation pathways and microorganisms involved, the potential health benefits, and the ability of these foodstuffs to impact the gut microbiome once ingested either through compounds produced during the fermentation process or through interactions with microorganisms from the fermented food that are capable of surviving in the gastro-intestinal transit. This review clearly shows that fermented foods can affect the gut microbiome in both the short and long term, and should be considered an important element of the human diet.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-05 04:01:14', '2026-04-05 04:13:46'),
(9, 1, 'Sweet Potatoes', 'food', '{\"image\":\"food-submissions\\/E1cU7QB8cfxlAU1ok34ZFphqP9O8hUHWedRaglyi.jpg\",\"ingredients\":[\"100% Sweet Potato\"],\"nutrition\":{\"calories\":\"86\",\"protein\":\"1.6\",\"carbs\":\"20\",\"fat\":\"0.1\",\"fiber\":\"3\"},\"description\":\"A starchy root vegetable (not a nightshade like white potatoes).\",\"autoimmune_notes\":\"High in Beta-carotene and fiber, which helps regulate the immune system and maintains a healthy weight.\",\"research\":{\"title\":\"Anthocyanins From Sweet Potatoes (Ipomoea batatas): Bioavailability, Mechanisms of Action, and Therapeutic Potential in Diabetes and Metabolic Disorders\",\"source\":\"Bioavailability, Mechanisms of Action, and Therapeutic Potential in Diabetes and Metabolic Disorders. Food Sci Nutr. 2025 Sep 4;13(9):e70895. doi: 10.1002\\/fsn3.70895. PMID: 40918166; PMCID: PMC12409302.\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC12409302\\/#:~:text=In%20addition%2C%20anthocyanins%20inhibit%20low,progression%20of%20type%202%20diabetes.\",\"summary\":\"Ipomoea batatas , commonly known as sweet potato, is an increasingly valued functional food because of its vivid coloration and rich bioactive compounds, especially anthocyanins and carotenoids, such as ipomoeaxanthin. This review focuses on the bioavailability, mechanisms of action, and therapeutic potential of sweet potato\\u2010derived anthocyanins in diabetes and metabolic disorders. Anthocyanins, which are plant pigments, exhibit high antioxidant activity by scavenging free radicals and stimulating endogenous antioxidant enzymes such as catalase and superoxide dismutase, thereby protecting cellular structures from damage and reducing oxidative damage in vital metabolic organs such as the pancreas, liver, brain, and muscles. Anthocyanins also increase insulin sensitivity, regulate glucose metabolism, and regulate enzymes involved in carbohydrate digestion, thus reducing the risk of diabetes. In addition, anthocyanins inhibit low\\u2010grade chronic inflammation by inhibiting the inflammatory mediators TNF\\u2010\\u03b1, IL\\u20106, and NF\\u2010\\u03baB signaling pathways implicated in the progression of type 2 diabetes. Clinical evidence supports preclinical animal models and ongoing human trials favoring sweet potato consumption to enhance glucose control and decrease insulin resistance. However, challenges remain regarding the poor bioavailability of anthocyanins and the need for stronger human studies. In addition to anthocyanins, sweet potatoes contain diverse nutrients that contribute to their metabolic health. This review highlights the significance of sweet potatoes as a functional food ingredient in diabetes prevention diets and encourages new processing methods that can sustain their bioactive potential.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-05 04:03:57', '2026-04-05 04:13:40'),
(10, 1, 'Broccoli', 'food', '{\"image\":\"food-submissions\\/0uKp1tLFrRIVCmkfd0bttZg10TxaYDXvx17eH9R7.jpg\",\"ingredients\":[\"100% Broccoli\"],\"nutrition\":{\"calories\":\"34\",\"protein\":\"2.8\",\"carbs\":\"6.6\",\"fat\":\"0.4\",\"fiber\":\"2.6\"},\"description\":\"An edible green plant in the cabbage family.\",\"autoimmune_notes\":\"Contains sulforaphane, which helps block enzymes that cause joint destruction and inflammation.\",\"research\":{\"title\":\"Glucosinolates From Cruciferous Vegetables and Their Potential Role in Chronic Disease: Investigating the Preclinical and Clinical Evidence\",\"source\":\"Front Pharmacol. 2021 Oct 26;12:767975. doi: 10.3389\\/fphar.2021.767975. PMID: 34764875; PMCID: PMC8575925.\",\"url\":\"https:\\/\\/pmc.ncbi.nlm.nih.gov\\/articles\\/PMC8575925\\/#:~:text=Current%20research%20suggests%20that%20glucosinolates,%2C%20and%20chemo%2Dprotective%20effects.\",\"summary\":\"An increasing body of evidence highlights the strong potential for a diet rich in fruit and vegetables to delay, and often prevent, the onset of chronic diseases, including cardiometabolic, neurological, and musculoskeletal conditions, and certain cancers. A possible protective component, glucosinolates, which are phytochemicals found almost exclusively in cruciferous vegetables, have been identified from preclinical and clinical studies. Current research suggests that glucosinolates (and isothiocyanates) act via several mechanisms, ultimately exhibiting anti-inflammatory, antioxidant, and chemo-protective effects. This review summarizes the current knowledge surrounding cruciferous vegetables and their glucosinolates in relation to the specified health conditions. Although there is evidence that consumption of a high glucosinolate diet is linked with reduced incidence of chronic diseases, future large-scale placebo-controlled human trials including standardized glucosinolate supplements are needed.\"},\"rating\":\"0.0\",\"like\":0,\"saved\":0}', 'approved', NULL, NULL, '2026-04-05 04:07:48', '2026-04-05 04:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `medical_surveys`
--

CREATE TABLE `medical_surveys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `height_cm` int(11) NOT NULL,
  `weight_kg` decimal(8,2) NOT NULL,
  `bmi` decimal(8,2) NOT NULL,
  `main_symptoms` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`main_symptoms`)),
  `symptom_duration` varchar(255) NOT NULL,
  `pain_level` int(11) NOT NULL,
  `fatigue_level` int(11) NOT NULL,
  `impact_on_daily_life` int(11) NOT NULL,
  `diet_description` text NOT NULL,
  `sleep_quality` int(11) NOT NULL,
  `sleep_duration` varchar(255) NOT NULL,
  `stress_level` int(11) NOT NULL,
  `water_consumption` int(11) NOT NULL,
  `smoking_status` varchar(255) NOT NULL,
  `alcohol_consumption` varchar(255) NOT NULL,
  `physical_activity_level` varchar(255) NOT NULL,
  `existing_diagnosis` text DEFAULT NULL,
  `medications` text DEFAULT NULL,
  `family_history` text DEFAULT NULL,
  `diagnosis_details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `morning_stiffness` varchar(255) DEFAULT NULL,
  `skin_symptoms` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`skin_symptoms`)),
  `eye_symptoms` varchar(255) DEFAULT NULL,
  `triggers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`triggers`)),
  `digestive_pattern` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medical_surveys`
--

INSERT INTO `medical_surveys` (`id`, `patient_name`, `age`, `gender`, `height_cm`, `weight_kg`, `bmi`, `main_symptoms`, `symptom_duration`, `pain_level`, `fatigue_level`, `impact_on_daily_life`, `diet_description`, `sleep_quality`, `sleep_duration`, `stress_level`, `water_consumption`, `smoking_status`, `alcohol_consumption`, `physical_activity_level`, `existing_diagnosis`, `medications`, `family_history`, `diagnosis_details`, `created_at`, `updated_at`, `morning_stiffness`, `skin_symptoms`, `eye_symptoms`, `triggers`, `digestive_pattern`) VALUES
(1, 'Haziq', 22, 'Male', 175, '80.00', '26.12', '\"[\\\"Joint Pain\\\",\\\"Fatigue\\\",\\\"Brain Fog\\\"]\"', 'Less than 1 week', 8, 10, 10, 'I try to eat a balanced meal most days, usually consisting of chicken, rice, and some broccoli. I eat out on weekends but attempt to stay nutritious during the work week. I could probably add more organic produce to my routine.', 8, '7-8', 4, 8, 'Non-smoker', 'Non-drinker', 'Moderate', 'Diabetes', 'Insulin', 'No', 'No', '2026-01-07 01:15:55', '2026-01-07 01:15:55', NULL, NULL, NULL, NULL, NULL),
(2, 'BtuBrader', 22, 'Male', 176, '78.00', '25.18', '\"[\\\"Joint Pain\\\",\\\"Skin Rash\\\"]\"', 'Less than 1 week', 2, 7, 3, 'vegetarian', 2, 'Less than 5', 7, 1, 'Non-smoker', 'Non-drinker', 'Sedentary', 'no', 'haha', 'hihi', 'huhu', '2026-01-07 05:51:31', '2026-01-07 05:51:31', NULL, NULL, NULL, NULL, NULL),
(3, 'limalima', 44, 'Male', 178, '78.00', '24.62', '\"[\\\"Joint Pain\\\",\\\"Muscle Pain\\\",\\\"Fever\\\"]\"', 'Less than 1 week', 2, 4, 6, 'vegetarian', 2, 'Less than 5', 7, 1, 'Non-smoker', 'Non-drinker', 'Sedentary', NULL, NULL, NULL, NULL, '2026-01-07 20:01:02', '2026-01-07 20:01:02', NULL, NULL, NULL, NULL, NULL),
(4, 'william', 34, 'Male', 167, '76.00', '27.25', '\"[\\\"Joint Pain\\\",\\\"Fatigue\\\",\\\"Skin Rash\\\",\\\"Muscle Pain\\\",\\\"Digestive Issues\\\"]\"', 'Less than 1 week', 10, 10, 10, 'fruit, vegetables, junky', 1, 'Less than 5', 10, 2, 'Former smoker', 'Heavily', 'Athlete', 'no', 'no', 'no', 'no', '2026-01-07 20:55:49', '2026-01-07 20:55:49', 'more_2h', '\"[\\\"butterfly_rash\\\",\\\"sun_sensitivity\\\"]\"', 'uveitis', '\"[\\\"food\\\",\\\"weather\\\"]\"', 'bloating'),
(5, 'william', 34, 'Male', 167, '76.00', '27.25', '\"[\\\"Joint Pain\\\",\\\"Fatigue\\\",\\\"Skin Rash\\\",\\\"Muscle Pain\\\",\\\"Digestive Issues\\\"]\"', 'Less than 1 week', 10, 10, 10, 'fruit, vegetables, junky', 1, 'Less than 5', 10, 2, 'Former smoker', 'Heavily', 'Athlete', 'no', 'no', 'no', 'no', '2026-01-07 21:06:45', '2026-01-07 21:06:45', 'more_2h', '\"[\\\"butterfly_rash\\\",\\\"sun_sensitivity\\\"]\"', 'uveitis', '\"[\\\"food\\\",\\\"weather\\\"]\"', 'bloating'),
(6, 'william', 34, 'Male', 167, '76.00', '27.25', '\"[\\\"Joint Pain\\\",\\\"Fatigue\\\",\\\"Skin Rash\\\",\\\"Muscle Pain\\\",\\\"Digestive Issues\\\"]\"', 'Less than 1 week', 10, 10, 10, 'fruit, vegetables, junky', 1, 'Less than 5', 10, 2, 'Former smoker', 'Heavily', 'Athlete', 'no', 'no', 'no', 'no', '2026-01-07 21:10:43', '2026-01-07 21:10:43', 'more_2h', '\"[\\\"butterfly_rash\\\",\\\"sun_sensitivity\\\"]\"', 'uveitis', '\"[\\\"food\\\",\\\"weather\\\"]\"', 'bloating'),
(7, 'william', 34, 'Male', 167, '76.00', '27.25', '\"[\\\"Joint Pain\\\",\\\"Fatigue\\\",\\\"Skin Rash\\\",\\\"Muscle Pain\\\",\\\"Digestive Issues\\\"]\"', 'Less than 1 week', 10, 10, 10, 'fruit, vegetables, junky', 1, 'Less than 5', 10, 2, 'Former smoker', 'Heavily', 'Athlete', 'no', 'no', 'no', 'no', '2026-01-07 21:11:19', '2026-01-07 21:11:19', 'more_2h', '\"[\\\"butterfly_rash\\\",\\\"sun_sensitivity\\\"]\"', 'uveitis', '\"[\\\"food\\\",\\\"weather\\\"]\"', 'bloating'),
(8, 'william', 34, 'Male', 167, '76.00', '27.25', '\"[\\\"Joint Pain\\\",\\\"Fatigue\\\",\\\"Skin Rash\\\",\\\"Muscle Pain\\\",\\\"Digestive Issues\\\"]\"', 'Less than 1 week', 10, 10, 10, 'fruit, vegetables, junky', 1, 'Less than 5', 10, 2, 'Former smoker', 'Heavily', 'Athlete', 'no', 'no', 'no', 'no', '2026-01-07 21:11:25', '2026-01-07 21:11:25', 'more_2h', '\"[\\\"butterfly_rash\\\",\\\"sun_sensitivity\\\"]\"', 'uveitis', '\"[\\\"food\\\",\\\"weather\\\"]\"', 'bloating'),
(9, 'william', 34, 'Male', 167, '76.00', '27.25', '\"[\\\"Joint Pain\\\",\\\"Fatigue\\\",\\\"Skin Rash\\\",\\\"Muscle Pain\\\",\\\"Digestive Issues\\\"]\"', 'Less than 1 week', 10, 10, 10, 'fruit, vegetables, junky', 1, 'Less than 5', 10, 2, 'Former smoker', 'Heavily', 'Athlete', 'no', 'no', 'no', 'no', '2026-01-07 21:14:25', '2026-01-07 21:14:25', 'more_2h', '\"[\\\"butterfly_rash\\\",\\\"sun_sensitivity\\\"]\"', 'uveitis', '\"[\\\"food\\\",\\\"weather\\\"]\"', 'bloating'),
(10, 'william', 34, 'Male', 167, '76.00', '27.25', '\"[\\\"Joint Pain\\\",\\\"Fatigue\\\",\\\"Skin Rash\\\",\\\"Muscle Pain\\\",\\\"Digestive Issues\\\"]\"', 'Less than 1 week', 10, 10, 10, 'fruit, vegetables, junky', 1, 'Less than 5', 10, 2, 'Former smoker', 'Heavily', 'Athlete', 'no', 'no', 'no', 'no', '2026-01-07 21:21:38', '2026-01-07 21:21:38', 'more_2h', '\"[\\\"butterfly_rash\\\",\\\"sun_sensitivity\\\"]\"', 'uveitis', '\"[\\\"food\\\",\\\"weather\\\"]\"', 'bloating'),
(11, 'William', 23, 'Male', 176, '74.00', '23.89', '\"[\\\"Joint Pain\\\",\\\"Skin Rash\\\"]\"', 'Less than 1 week', 10, 1, 10, 'fruit vegetable', 1, 'Less than 5', 10, 2, 'Former smoker', 'Heavily', 'Active', 'no', 'no', 'no', 'no', '2026-01-08 01:15:47', '2026-01-08 01:15:47', 'less_30min', '\"[\\\"butterfly_rash\\\",\\\"silvery_scales\\\",\\\"none\\\"]\"', 'dry_eyes', '\"[\\\"stress\\\",\\\"hormonal\\\"]\"', 'pain_relief'),
(12, 'William', 23, 'Male', 176, '74.00', '23.89', '\"[\\\"Joint Pain\\\",\\\"Skin Rash\\\"]\"', 'Less than 1 week', 10, 1, 10, 'fruit vegetable', 1, 'Less than 5', 10, 2, 'Former smoker', 'Heavily', 'Active', 'no', 'no', 'no', 'no', '2026-01-08 01:18:37', '2026-01-08 01:18:37', 'less_30min', '\"[\\\"butterfly_rash\\\",\\\"silvery_scales\\\",\\\"none\\\"]\"', 'dry_eyes', '\"[\\\"stress\\\",\\\"hormonal\\\"]\"', 'pain_relief'),
(13, 'William', 23, 'Male', 176, '74.00', '23.89', '\"[\\\"Joint Pain\\\",\\\"Skin Rash\\\"]\"', 'Less than 1 week', 10, 1, 10, 'fruit vegetable', 1, 'Less than 5', 10, 2, 'Former smoker', 'Heavily', 'Active', 'no', 'no', 'no', 'no', '2026-01-08 01:22:13', '2026-01-08 01:22:13', 'less_30min', '\"[\\\"butterfly_rash\\\",\\\"silvery_scales\\\",\\\"none\\\"]\"', 'dry_eyes', '\"[\\\"stress\\\",\\\"hormonal\\\"]\"', 'pain_relief');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_12_04_101954_add_personal_info_to_medical_surveys_table', 1),
(6, '2025_12_14_122331_add_role_to_users_table', 1),
(7, '2025_12_22_120340_create_foods_table', 1),
(8, '2026_01_04_140149_create_food_submissions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$ouzJ0rFogxMi0hlf4pqm8eJNTvmKI50Ls5JODfT6IKE5xa08igsLq', NULL, '2026-01-07 01:12:13', '2026-01-07 01:12:13', 'admin'),
(2, 'hadif', 'hadiffikrifirdaus@gmail.com', NULL, '$2y$12$Ef3JLff3ME1a2iPYuNPRseu8HIpYed50zYxnoXxuN/n9lBacGa0ty', NULL, '2026-01-07 01:12:29', '2026-01-07 01:12:29', 'user'),
(3, 'Haziq', 'haziq@gmail.com', NULL, '$2y$12$0k/TX0epI64vQNpdioaNmeYx4JUVSx7GG5OhQvf86ET1yROIgCHFy', NULL, '2026-01-07 19:56:15', '2026-01-07 19:56:15', 'user'),
(4, 'pmx', 'pmx@gmail.com', NULL, '$2y$12$uJ5g7JK5/C8YJVQ.t324qui3ZWxBc1MAOLhj6O.hDG6.uQiwxPVkW', NULL, '2026-01-07 23:29:21', '2026-01-07 23:29:21', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_submissions`
--
ALTER TABLE `food_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_submissions_user_id_foreign` (`user_id`);

--
-- Indexes for table `medical_surveys`
--
ALTER TABLE `medical_surveys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `food_submissions`
--
ALTER TABLE `food_submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `medical_surveys`
--
ALTER TABLE `medical_surveys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food_submissions`
--
ALTER TABLE `food_submissions`
  ADD CONSTRAINT `food_submissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
