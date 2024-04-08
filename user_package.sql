

INSERT INTO `user_package` (`id`, `account_no`, `invoice`, `package`, `coverage`, `total`, `category`, `period`, `variant`, `due_date`, `status`, `process_status`, `updated_at`, `date`) VALUES
(1, '644354012073417284087072', '063375600', 'Package eme 1', 'Coverage eme 1', '999.00', 'Fiber', 'Apr 2024', 'false', '21 Apr 2024', 'Paid', 'Done', '2024-04-04 00:56:05', '2024-03-21 00:50:38'),
(3, '644354012073417284087072', '460682398', 'Package eme 5', 'Coverage eme 4', '678.00', 'Fiber', 'Apr 2024', 'false', '22 Apr 2024', 'Paid', 'Done', '2024-03-23 05:48:30', '2024-03-22 14:07:47'),
(4, '644354012073417284087072', '047250758', 'Package eme 3', 'Coverage eme 5', '789.00', 'Fiber', 'May 2024', 'false', '04 May 2024', 'Paid', 'Done', '2024-04-04 00:56:54', '2024-04-04 00:54:31'),
(6, '644354012073417284087072', '508838856', 'Package eme 5', 'Coverage eme 4', '789.00', 'Fiber', 'Dec 2024', 'true', '11 Dec 2024', 'Paid', 'Done', '2024-04-07 05:27:53', '2024-04-07 05:27:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_package`
--
ALTER TABLE `user_package`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_package`
--
ALTER TABLE `user_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
